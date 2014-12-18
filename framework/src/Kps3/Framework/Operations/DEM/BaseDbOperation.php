<?php
  namespace Kps3\Framework\Operations\DEM {

    use Kps3\Framework\DEM\Context\BaseDbContext;
    use Kps3\Framework\Operations\BaseOperation;

    abstract class BaseDbOperation extends BaseOperation {

      public function __construct(BaseDbContext $context) {
        $this->context = $context;
      }

      /**
       * @var BaseDbContext
       */
      protected $context;

      /**
       * @return \Illuminate\Database\Connection
       */
      protected function getDatabase() {
        return \DB::connection();
      }

    }
  }