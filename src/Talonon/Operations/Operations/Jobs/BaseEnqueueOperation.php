<?php


namespace Talonon\Operations\Jobs {

  use Talonon\Operations\Context\BaseContext;
  use Talonon\Operations\Operations\BaseOperation;

  abstract class BaseEnqueueOperation extends BaseOperation {

    public function __construct(BaseContext $context) {
      $this->context = $context;
    }

    /**
     * @var BaseContext
     */
    protected $context;
    protected abstract function getOperation();
    protected abstract function getQueue();

    /**
     * By default fires now!
     * @return null
     */
    protected function getTimeToFire() {
      return null;
    }

    protected function doExecute() {
      if ($this->getTimeToFire()) { // Push it later!
        \Queue::later($this->getTimeToFire(), '\Talonon\Framework\Jobs\ExecuteOperationJob', ['operation' => serialize($this->getOperation())], $this->getQueue());
      }
      else { // Push it now!
        \Queue::push('\Talonon\Framework\Jobs\ExecuteOperationJob', ['operation' => serialize($this->getOperation())], $this->getQueue());
      }
    }
  }

}
