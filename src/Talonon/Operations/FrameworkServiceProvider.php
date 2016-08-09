<?php

  namespace Talonon\Operations {

    use Illuminate\Support\ServiceProvider;
    use Talonon\Operations\Commands\BuildEntityCommand;
    use Talonon\Operations\Commands\ModelBuilderCommand;
    use Talonon\Operations\Exceptions\InternalException;

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
        $this->publishes([
                           __DIR__.'/../../config/config.php' => config_path('kps3framework.php'),
                         ]);
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