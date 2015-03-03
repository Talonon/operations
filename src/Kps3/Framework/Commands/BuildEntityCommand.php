<?php

  namespace Kps3\Framework\Commands {

    use Illuminate\Console\Command;
    use Illuminate\Database\Connection;
    use Illuminate\Support\Pluralizer;
    use Illuminate\Support\Str;
    use Kps3\Framework\Builder\BaseBuilder;
    use Kps3\Framework\Builder\CreateOperationBuilder;
    use Kps3\Framework\Builder\DeleteOperationBuilder;
    use Kps3\Framework\Builder\EntityBuilder;
    use Kps3\Framework\Builder\GetListOperationBuilder;
    use Kps3\Framework\Builder\GetOperationBuilder;
    use Kps3\Framework\Builder\MapperBuilder;
    use Kps3\Framework\Builder\SearchParamsBuilder;
    use Kps3\Framework\Builder\SoftDeleteOperationBuilder;
    use Kps3\Framework\Builder\UpdateOperationBuilder;
    use Kps3\Framework\Builder\CreateTraitBuilder;
    use Kps3\Framework\Builder\DeleteTraitBuilder;
    use Kps3\Framework\Builder\GetListTraitBuilder;
    use Kps3\Framework\Builder\GetTraitBuilder;
    use Kps3\Framework\Builder\SoftDeleteTraitBuilder;
    use Kps3\Framework\Builder\UpdateTraitBuilder;
    use Symfony\Component\Console\Input\InputArgument;
    use Illuminate\Database\Schema\Builder;

    class BuildEntityCommand extends Command {

      /**
       * The console command name.
       *
       * @var string
       */
      protected $name = 'kps3:build-entity';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Build\'s a KPS3-Framework model/mapper/create/update/delete/softdelete/get/getlist operations and traits.';

      /**
       * Create a new command instance.
       *
       * @return void
       */
      public function __construct() {
        parent::__construct();
      }

      private $_config = [
        'name'             => null,
        'namespace'        => null,
        'table'            => null,
        'primaryKey'       => null,
        'get'              => false,
        'getList'          => false,
        'create'           => false,
        'update'           => false,
        'delete'           => false,
        'softDelete'       => false,
        'softDeleteColumn' => false,
        'trackDates'       => false,
        'auto-build'       => false,
      ];

      /**
       * Execute the console command.
       *
       * @return mixed
       */
      public function fire() {
        $this->_getName();
        $this->_buildConfig();
        $this->_makeBuilders();
        $this->_confirmConfig();
        $this->_build();
      }

      private $_builders = ['Models'=>[],'Operations'=>[],'Traits'=>[],'Mappers'=>[]];

      private function _buildConfig() {
        $namespace = $this->_ask('Entity Namespace', Pluralizer::plural($this->_config['name']), []);
        $this->_config['namespace'] = $namespace;
        $db = $this->_getDatabase();
        $table = null;
        $primaryKey = null;
        $table = null;
        if ($db) {
          $default = strtolower(Str::snake(Pluralizer::plural($this->_config['name'])));
          $this->_config['table'] = $this->_ask('What is the name of the table in the database?', $default, []);

          $default = strtolower(Str::snake(Pluralizer::singular($this->_config['name']))) . '_id';
          $this->_config['primaryKey'] = $this->_ask('What is the primary key of the table in the database?', $default, []);
        }
        $this->_config['get'] = $this->_askYN('Do you want a Get Single Operation/Trait?', true);
        $this->_config['getList'] = $this->_askYN('Do you want a Get List Operation/Trait/SearchParams? ', true);
        $this->_config['create'] = $this->_askYN('Do you want a CreateOperation/Trait?', true);
        $this->_config['update'] = $this->_askYN('Do you want a UpdateOperation/Trait?', true);
        $this->_config['delete'] = $this->_askYN('Do you want a DeleteOperation/Trait?', false);
        $this->_config['softDelete'] = $this->_askYN('Should Entity be Soft Deletable?', false);
        $this->_config['softDeleteColumn'] = null;
        if ($this->_config['softDelete']) {
          $this->_config['softDeleteColumn'] = $this->ask('What is the column name that indicates that the model is deleted from the database? (Default: deleted): ', 'deleted');
        }
        $table = $this->_getTable();
        if ($table) {
          $this->_config['auto-build'] = $this->_askYN('Do you want to build the entity properties based on the database columns?');
          if (\Schema::hasColumn($this->_config['table'], 'created_date') && \Schema::hasColumn($this->_config['table'], 'modified_date')) {
            $this->_config['trackDates'] = true;
          }
          else {
            $this->info('*** create_date and modified_date columns not found.  Entity will not track dates. ***');
          }
        }
        else {
          $this->info('*** Table not found, auto-build is disabled. ***');
          $this->_config['trackDates'] = $this->_askYN('Will database track created_date and modified_date?', false);
        }
      }

      private function _makeBuilders() {
        BaseBuilder::SetDefaults($this->_config);
        $this->_builders['Models'][] = new EntityBuilder();
        $this->_builders['Mappers'][] = new MapperBuilder();
        $this->_config['getList'] && $this->_builders['Models'][] = new SearchParamsBuilder();
        $this->_config['get'] && $this->_builders['Operations'][] = new GetOperationBuilder();
        $this->_config['getList'] && $this->_builders['Operations'][] = new GetListOperationBuilder();
        $this->_config['create'] && $this->_builders['Operations'][] = new CreateOperationBuilder();
        $this->_config['update'] && $this->_builders['Operations'][] = new UpdateOperationBuilder();
        $this->_config['delete'] && $this->_builders['Operations'][] = new DeleteOperationBuilder();
        $this->_config['softDelete'] && $this->_builders['Operations'][] = new SoftDeleteOperationBuilder();
        $this->_config['get'] && $this->_builders['Traits'][] = new GetTraitBuilder();
        $this->_config['getList'] && $this->_builders['Traits'][] = new GetListTraitBuilder();
        $this->_config['create'] && $this->_builders['Traits'][] = new CreateTraitBuilder();
        $this->_config['update'] && $this->_builders['Traits'][] = new UpdateTraitBuilder();
        $this->_config['delete'] && $this->_builders['Traits'][] = new DeleteTraitBuilder();
        $this->_config['softDelete'] && $this->_builders['Traits'][] = new SoftDeleteTraitBuilder();
      }

      private function _build() {
        $this->info('BUILDING...');
        foreach ($this->_builders as $name => $builders) {
          if (count($builders) > 0) {
            $this->info('  ' . $name . ':');
            for ($x=0,$c=count($builders); $x<$c; $x++) {
              $this->info('    ' . $builders[$x]->GetDebug());
              $builders[$x]->Build();
            }
          }
        }
      }

      private function _confirmConfig() {
        $this->info('This is what we\'re going to build: ');
        foreach ($this->_builders as $name => $builders) {
          if (count($builders) > 0) {
            $this->info('  ' . $name . ':');
            for ($x=0,$c=count($builders); $x<$c; $x++) {
              $this->info('    ' . $builders[$x]->GetDebug());
            }
          }
        }
        if (!$this->_askYN('Does this look okay?')) {
          $this->error('User cancelled.');
          die;
        }
      }

      private function _getNamespace($type, $entityNS = true) {
        return \Config::get('framework::EntityBuilder.BaseNamespace') . '\\' . Pluralizer::plural($type) . ($entityNS ? '\\' . $this->_config['namespace'] : '');
      }

      private function _getFilename($base, $type, $entityDir = true) {
        $file = \Config::get('framework::EntityBuilder.SrcDirectory', storage_path('entity-builder'));
        return rtrim($file, '/') . '/' . Pluralizer::plural($type) . '/' . ($entityDir ? $this->_config['namespace'] . '/' : '') . $base . '.php';
      }

      private function _ask($question, $default = 'yes', $options = array('yes', 'no')) {
        $noOptions = !is_array($options) || count($options) == 0;
        if ($noOptions) {
          $data = null;
        } else {
          $data = '[' . implode('/', $options) . '] ';
        }
        $valid = false;
        while (!$valid) {
          $defaultText = !is_null($default) ? '(Default: ' . $default . ')' : '';
          $result = $this->askWithCompletion(trim($question) . ' ' . $data . $defaultText . ': ', $options, $default);
          if ($noOptions || in_array($result, $options)) {
            return $result;
          }
          $this->error('Invalid option ' . $result);
        }
      }

      private function _askYN($question, $default = 'yes') {
        $default = (!is_null($default) && $default && $default !== 'no') ? 'yes' : 'no';
        return $this->_ask($question, $default) == 'yes';
      }

      private function _getName() {
        $name = $this->argument('modelName');
        $singularName = Pluralizer::singular($name);
        if ($name != $singularName) {
          if (($action = $this->_ask('<error>Model names should be singlar. Do you want to continue with this name or rename it to be singlar?</error> ', 'no', ['yes', 'no', 'rename'])) == 'no') {
            $this->error('Name was not accepted.');
            die;
          }
          if ($action == 'rename') {
            if ($this->ask($singularName . ' is the new model name, continue? (Default: 1): ', true)) {
              $name = $singularName;
            } else {
              $this->error('Out of things to ask.  Can\'t continue.');
            }
          }
        }
        $this->_config['name'] = $name;
      }

      /**
       * @return Connection
       */
      private function _getDatabase() {
        if (!$this->_db) {
          try {
            $db = \DB::connection();
            $this->_db = $db;
          } catch (\Exception $ex) {
            $this->error('No database found, auto-build is disabled.');
            $this->_db = null;
          }
        }
        return $this->_db;
      }

      private $_db;
      private $_table;

      /**
       * @return Builder
       */
      private function _getTable() {
        if (is_null($this->_table)) {
          $db = $this->_getDatabase();
          if ($db) {
            if (\Schema::hasTable($this->_config['table'])) {
              $this->_table = true;
            }
          }
        }
        return $this->_table;
      }

      /**
       * Get the console command arguments.
       *
       * @return array
       */
      protected function getArguments() {
        return array(
          array('modelName', InputArgument::REQUIRED, 'Name of the model to create.'),
        );
      }

      /**
       * Get the console command options.
       *
       * @return array
       */
      protected function getOptions() {
        return array();
      }

    }

  }
