<?php

  namespace Kps3\Framework {

    use Illuminate\Support\ServiceProvider;
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