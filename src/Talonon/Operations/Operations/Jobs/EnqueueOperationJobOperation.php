<?php


  namespace Talonon\Operations\Jobs {

    use Carbon\Carbon;
    use Talonon\Operations\Context\BaseContext;
    use Talonon\Operations\Operations\BaseOperation;

    class EnqueueOperationJobOperation extends BaseEnqueueOperation {

      public function __construct(BaseContext $context, BaseOperation $operation, $queue = "default", Carbon $time = null) {
        parent::__construct($context);
        $this->_op = $operation;
        $this->_queue = $queue ?: "default";
        $this->_time = $time;
      }

      /**
       * @var BaseOperation
       */
      private $_op;
      private $_queue;
      /**
       * @var Carbon
       */
      private $_time;

      protected function getOperation() {
        return $this->_op;
      }

      protected function getQueue() {
        return $this->_queue;
      }

      protected function getTimeToFire() {
        return $this->_time;
      }
    }
  }
