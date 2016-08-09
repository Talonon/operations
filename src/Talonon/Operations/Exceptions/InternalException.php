<?php

  namespace Talonon\Operations\Exceptions {

    class InternalException extends \Exception {
      public function __construct($message = "", $code = 0, \Exception $previous = null) {
        $previousMessage = $previous instanceof \Exception ? $previous->getMessage() : '';
        $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR'])  ? $_SERVER['HTTP_X_FORWARDED_FOR'] : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'command line');
        \Log::error($message, array('ip' => $ip, 'code' => $code, 'previous' => $previousMessage));
        parent::__construct($message, $code, $previous);
      }
    }

  }
