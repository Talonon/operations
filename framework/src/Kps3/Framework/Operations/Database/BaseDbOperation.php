<?php
  namespace Kps3\Framework\Operations\Database {

    use Kps3\Framework\Context\BaseDbContext;
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
        return $this->context->GetDatabase();
      }

    }
  }