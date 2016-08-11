<?php

  namespace Talonon\Operations\Mappers {

    use Talonon\Operations\Models\BaseEntity;

    abstract class BaseMapper {

      /**
       * @param array $data
       * @return BaseEntity
       */
      public function BuildMultiple(array $data) : BaseEntity {
        return $this->BuildSingle($data);
      }

      /**
       * @param array $data
       * @return BaseEntity
       */
      abstract public function BuildSingle(array $data) : BaseEntity;
    }
  }

