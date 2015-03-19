<?php

  namespace Kps3\Framework\Exceptions {

    class EntityNotFoundException extends InternalException {

      public function __construct($entityType, $id) {
        parent::__construct($entityType . ' not found with id ' . (is_array($id) ? print_r($id, true) : $id));
      }

    }
  }
