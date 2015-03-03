<?php


  namespace Kps3\Framework\Interfaces {

    /**
     * An indicator to the mapper that a BaseEntity model that implements this interface should have the columns
     * "created_date" and "modified_date" populated during create and updated operations.  The database table must
     * have these columns and they must be datetime columns.
     * Interface TrackDatesInterface
     * @package Kps3\Framework\Interfaces
     */
    interface TrackDatesInterface {

    }

  }
