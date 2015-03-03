<?php
  namespace Kps3\Framework\Operations\Database {

    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Interfaces\SoftDeleteMapperInterface;

    abstract class BaseSoftDeleteOperation extends BaseUpdateOperation {

      protected function getFields() {
        return [
          $this->getMapper()->GetDeletedColumnName() => true
        ];
      }
    }
  }