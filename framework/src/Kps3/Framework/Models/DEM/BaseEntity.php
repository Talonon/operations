<?php
  namespace Kps3\Framework\Models\DEM {

    abstract class BaseEntity {
      private $_id;
      private $_name;

      /**
       * @return mixed
       */
      public function GetId() {
        return $this->_id;
      }

      /**
       * @param mixed $id
       * @return $this
       */
      public function SetId($id) {
        $this->_id = $id;
        return $this;
      }

      /**
       * @return string
       */
      public function GetName() {
        return $this->_name;
      }

      /**
       * @param string $name
       * @return $this
       */
      public function SetName($name) {
        $this->_name = $name;
        return $this;
      }
    }

  }
