<?php


  namespace Kps3\Framework\Mappers {

    abstract class BaseSoftDeleteDbMapper extends BaseDbMapper {

      public function GetDeletedColumnName() {
        return 'deleted_at';
      }

    }

  }
