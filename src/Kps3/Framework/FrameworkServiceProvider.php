<?php

  namespace Kps3\Framework {

    use Illuminate\Support\ServiceProvider;
    use Kps3\Framework\Commands\BuildEntityCommand;
    use Kps3\Framework\Commands\ModelBuilderCommand;
    use Kps3\Framework\Exceptions\InternalException;

    class FrameworkServiceProvider extends ServiceProvider {

      /**
       * Indicates if loading of the provider is deferred.
       *
       * @var bool
       */
      protected $defer = false;

      /**
       * Register the service provider.
       *
       * @return void
       */
      public function register() {
        $this->_registerCommands();
        $this->commands('mycommand');

      }

      private function _registerCommands() {
        $this->app['mycommand'] = $this->app->share(function($app)
        {
          return new BuildEntityCommand();
        });
      }


      public function boot() {
        if (\Config::get('database.fetch') != \PDO::FETCH_ASSOC) {
          throw new InternalException('database.fetch must be PDO::FETCH_ASSOC');
        }
        $this->package('kps3/framework');
      }

      /**
       * Get the services provided by the provider.
       *
       * @return array
       */
      public function provides() {
        return array();
      }

    }

  }