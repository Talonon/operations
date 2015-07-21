<?php
  namespace Kps3\Framework\Models {

    abstract class BaseSoftDeleteEntity extends BaseEntity {
      private $_deletedAt;

      /**
       * @return mixed
       */
      public function GetDeletedAt() {
        return $this->_deletedAt;
      }

      /**
       * @param mixed $deletedAt
       * @return BaseSoftDeleteEntity
       */
      public function SetDeletedAt($deletedAt) {
        $this->_deletedAt = $deletedAt;
        return $this;
      }
    }
  }
