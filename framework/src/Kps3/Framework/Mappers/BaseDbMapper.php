<?php

  namespace Kps3\Framework\Mappers {

    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseDbMapper extends BaseMapper {

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

      abstract public function GetTableName();

      abstract public function GetPrimaryKey();

    }
  }

