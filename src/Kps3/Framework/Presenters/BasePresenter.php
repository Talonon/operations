<?php

  namespace Kps3\Framework\Presenters {

    abstract class BasePresenter {

      protected $model;

      public function __construct(PresentableInterface $model) {
        $this->model = $model;
      }

      public function __call($method, $params) {
        if (is_callable(array($this->model, $method))) {
          return call_user_func_array(array($this->model, $method), $params);
        }
        else {
          $class = get_class($this);
          $trace = debug_backtrace();
          $file = $trace[0]['file'];
          $line = $trace[0]['line'];
          trigger_error("Call to undefined method $class::$method() in $file on line $line", E_USER_ERROR);
        }
      }
    }
  }