<?php


  namespace Talonon\Operations\Interfaces {

    /**
     * An indicator to the mapper that a BaseEntity model that implements this interface should have the columns
     * "created_at" and "updated_at" populated during create and updated operations.  The database table must
     * have these columns and they must be datetime/timestamp columns.
     * Interface TimestampsInterface
     * @package Talonon\Operations\Interfaces
     */
    interface TimestampsInterface {

    }

  }
