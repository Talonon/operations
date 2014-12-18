<?php

  namespace Kps3\Framework\DEM\Mappers {

    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Models\DEM\BaseEntity;

    abstract class BaseMapper {

      /**
       * @param array $data
       * @return BaseEntity
       */
      public function BuildMultiple(array $data) {
        return $this->BuildSingle($data);
      }

      /**
       * Gets an associated array of fields that are used to create a record in the database.  The key of the array
       * is the column name, the value of the element in the array is the value that will be saved in the database.
       * @param BaseEntity $entity
       * @returns array
       * @throws InternalException
       */
      public function GetCreateFields(BaseEntity $entity) {
        throw new InternalException('Not Implemented');
      }

      /**
       * Gets an associated array of fields that are used to update a record in the database.  The key of the array
       * is the column name, the value of the element in the array is the value that will be saved in the database.
       * This list should not include the primary key values.
       * @param BaseEntity $entity
       * @returns array
       * @throws InternalException
       */
      public function GetUpdateFields(BaseEntity $entity) {
        throw new InternalException('Not Implemented');
      }

      /**
       * @param array $data
       * @return BaseEntity
       */
      abstract public function BuildSingle(array $data);

      abstract public function GetTableName();

      abstract public function GetPrimaryKey();

    }
  }

