<?php


  namespace Kps3\Framework\Mappers {

    use Kps3\Framework\Interfaces\SoftDeleteMapperInterface;

    abstract class BaseSoftDeleteDbMapper extends BaseDbMapper implements SoftDeleteMapperInterface {

      public function GetDeletedColumnName() {
        return 'deleted_at';
      }

    }

  }
