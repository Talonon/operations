<?php


  namespace Talonon\Operations\Mappers {

    use Talonon\Operations\Interfaces\SoftDeleteMapperInterface;

    abstract class BaseSoftDeleteDbMapper extends BaseDbMapper implements SoftDeleteMapperInterface {

      public function GetDeletedColumnName() {
        return 'deleted_at';
      }

    }

  }
