<?php


  namespace Kps3\Framework\Interfaces {

    /**
     * Indicates that a BaseEntity that implements this interface should be soft deleted by the soft delete operation.
     * Interface SoftDeleteInterface
     * @package Kps3\Framework\Interfaces
     */
    interface SoftDeletableEntityInterface {
      function GetDeleted();

      function SetDeleted($deleted);
    }

  }
