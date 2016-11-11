<?php

  namespace Talonon\Operations\Mappers {

    use Carbon\Carbon;
    use Talonon\Operations\Exceptions\InternalException;
    use Talonon\Operations\Interfaces\TimestampsInterface;
    use Talonon\Operations\Models\BaseEntity;

    abstract class BaseDbMapper extends BaseMapper {

      protected $autoIncrementingID = true;

      /**
       * Sometimes tables don't use autoincrementing IDs, setting this to false will prevent the create from using
       * the LAST_INSERT_ID and passing it to SetID().  By default its on because most tables will use it.
       * @return boolean
       */
      public function GetAutoIncrementingID(): bool {
        return $this->autoIncrementingID;
      }

      /**
       * Gets an associated array of fields that are used to create a record in the database.  The key of the array
       * is the column name, the value of the element in the array is the value that will be saved in the database. Will
       * automagically change updated and created date for models that implement the TimestampsInterface
       * @param BaseEntity $entity
       * @returns array
       * @throws InternalException
       */
      public function GetCreateFields(BaseEntity $entity) {
        $fields = $this->doGetCreateFields($entity);
        if ($entity instanceof TimestampsInterface) {
          $fields += [
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
          ];
        }
        return $fields;
      }

      /**
       * Gets an associated array of fields that are used to update a record in the database.  The key of the array
       * is the column name, the value of the element in the array is the value that will be saved in the database.
       * This list should not include the primary key values.  Will automagically change updated date for models
       * that implement the TimestampsInterface
       * @param BaseEntity $entity
       * @returns array
       * @throws InternalException
       */
      public function GetUpdateFields(BaseEntity $entity) {
        $fields = $this->doGetUpdateFields($entity);
        if ($entity instanceof TimestampsInterface) {
          $fields += [
            'updated_at' => Carbon::now()
          ];
        }
        return $fields;
      }

      /**
       * @param BaseEntity $entity
       * @returns array
       * @throws InternalException
       */
      protected function doGetUpdateFields(BaseEntity $entity) {
        throw new InternalException('Not Implemented');
      }

      /**
       * @param BaseEntity $entity
       * @returns array
       * @throws InternalException
       */
      protected function doGetCreateFields(BaseEntity $entity) {
        throw new InternalException('Not Implemented');
      }

      abstract public function GetTableName();

      abstract public function GetPrimaryKey();

    }
  }

