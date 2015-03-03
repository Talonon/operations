<?php

  namespace Kps3\Framework {

    use Illuminate\Support\ServiceProvider;

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