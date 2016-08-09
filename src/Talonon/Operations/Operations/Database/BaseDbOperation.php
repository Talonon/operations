<?php
  namespace Talonon\Operations\Operations\Database {

    use Talonon\Operations\Context\BaseDbContext;
    use Talonon\Operations\Operations\BaseOperation;

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