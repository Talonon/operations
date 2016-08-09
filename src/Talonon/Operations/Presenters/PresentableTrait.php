<?php

  namespace Talonon\Operations\Presenters {

    trait PresentableTrait {

      protected $presenterInstance;

      public function Present() {

        if (!property_exists($this, 'presenter') || !class_exists($this->presenter)) {
          throw new PresenterException('Please set the $protected property to your presenter path.');
        }

        if (!isset($this->presenterInstance)) {
          $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
      }
    }
  }