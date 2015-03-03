<?php

  namespace Kps3\Framework\Mappers {

    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseMapper {

      /**
       * @param array $data
       * @return BaseEntity
       */
      public function BuildMultiple(array $data) {
        return $this->BuildSingle($data);
      }

      /**
       * @param array $data
       * @return BaseEntity
       */
      abstract public function BuildSingle(array $data);
    }
  }

