<?php

  namespace Talonon\Operations\Queues {

    use Illuminate\Console\Command;
    use Talonon\Operations\Operations\BaseOperation;

    class ExecuteOperationJob extends Command { //@TODO Refactor for Laravel 5.

      public function fire($job, $data) {
        $operation = @unserialize($data['operation']);
        if ($operation instanceof BaseOperation) {
          $operation->Execute();
          $job->delete();
        }
        else {
          $job->delete();
          throw new \Exception('Invalid Operation');
        }
      }
    }
  }