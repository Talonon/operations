<?php

  namespace Kps3\Framework\Builder {
    use Illuminate\Support\Pluralizer;

    abstract class BaseBuilder {

      protected $namespace;
      protected $name;

      private static $_config;

      abstract protected function getType();

      abstract protected function getTemplateFilename();

      protected function getClassName() {
        return $this->getClassNamePrefix() . self::getConfig('name') . $this->getType();
      }

      protected function getClassNamePrefix() {
        return '';
      }

      protected function usesEntityNamespace() {
        return true;
      }

      protected function getNamespace($type = null, $useEntityNamespace = null) {
        $type = is_null($type) ? $this->getType() : $type;
        $useEntityNamespace = is_null($useEntityNamespace) ? $this->usesEntityNamespace() : $useEntityNamespace;
        return \Config::get('framework::EntityBuilder.BaseNamespace') . '\\' . Pluralizer::plural($type) . ($useEntityNamespace ? '\\' . self::getConfig('namespace') : '');
      }

      protected function getFilename() {
        $file = \Config::get('framework::EntityBuilder.SrcDirectory', storage_path('entity-builder'));
        return rtrim($file, '/') . '/' . Pluralizer::plural($this->getType()) . '/' . ($this->usesEntityNamespace() ? self::getConfig('namespace') . '/' : '') . $this->getClassName() . '.php';
      }

      protected function getContent() {
        return file_get_contents(dirname(__FILE__) . '/Templates/' . $this->getTemplateFilename());
      }


      public function Build() {
        $dir = dirname($this->getFilename());
        if (!is_dir($dir)) {
          mkdir($dir, 0775, true);
        }
        $fs = fopen($this->getFileName(), 'w');
        $content = $this->getContent();
        $data = $this->getTemplateData();
        fwrite($fs, str_replace(array_keys($data), array_values($data), $content));
        fclose($fs);
      }

      protected function getTemplateData() {
        return [
          '__NAMESPACE__'       => $this->getNamespace(),
          '__MODEL__'           => self::getConfig('name'),
          '__MODEL_NAMESPACE__' => $this->getNamespace('Model', true) . '\\' . self::getConfig('name')
        ];
      }

      public function GetDebug() {
        $exists = file_exists($this->getFileName());
        return "    " . $this->getNamespace() . "\\" . $this->getClassName() . " => " . $this->getFileName() . ($exists ? ' <error>[FILE EXISTS]</error>' : null);
      }

      public static function SetDefaults($config) {
        self::$_config = $config;
      }

      protected static function getConfig($value) {
        return self::$_config[$value];
      }
    }
  }