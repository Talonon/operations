<?php
  namespace Kps3\Framework\Operations\Database {

    use Carbon\Carbon;
    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Mappers\BaseSoftDeleteDbMapper;

    abstract class BaseSoftDeleteOperation extends BaseUpdateOperation {

      protected function getMapper() {
        $mapper = parent::getMapper();
        if (!$mapper instanceof BaseSoftDeleteDbMapper) {
          throw new InternalException('Mapper for ' . $this->entityType . ' must extend BaseSoftDeleteDbMapper.');
        }
      }

      protected function getFields() {
        return [
          $this->getMapper()->GetDeletedColumnName() => Carbon::now()
        ];
      }
    }
  }