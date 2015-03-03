<?php
  use \Kps3\Framework\Models\BaseEntity;
  use \Kps3\Framework\Mappers\BaseDbMapper;
  use __MODEL_NAMESPACE__;
  __IMPLEMENTS_USE__

  class __MODEL__Mapper extends BaseDbMapper__IMPLEMENTS__ {

    public function BuildSingle(array $data) {
      return (new __MODEL__())__SETTERS__;
    }

    public function GetTableName() {
      return '__TABLE__';
    }

    public function GetPrimaryKey() {
      return '__PRIMARY__';
    }

    /**
    * @param __MODEL__ $entity
    * @return array
    */
    public function GetCreateFields(BaseEntity $entity) {
      return parent::GetCreateFields($entity) + [__FIELDS__
      ];
    }

    /**
    * @param __MODEL__ $entity
    * @return array
    */
    public function GetUpdateFields(BaseEntity $entity) {
      return parent::GetUpdateFields($entity) + [__FIELDS__
      ];
    }

    __DELETED_METHOD__

  }

