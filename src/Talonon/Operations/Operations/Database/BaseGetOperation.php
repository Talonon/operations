<?php
  namespace Talonon\Operations\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Talonon\Operations\Interfaces\ResultInterface;

    abstract class BaseGetOperation extends BaseEntityOperation implements ResultInterface {

      /**
       * The result holder
       * @var mixed
       */
      protected $result;
      protected $rows;

      protected function doExecute() {
        $select = $this->getTable();
        $this->buildQuery($select);
        $this->rows = $select->get();
        $this->buildResult();
      }

      protected abstract function buildQuery(Builder $select);

      protected abstract function buildResult();

      public function GetResult() {
        return $this->result;
      }
    }
  }