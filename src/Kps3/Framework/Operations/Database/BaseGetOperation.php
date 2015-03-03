<?php
  namespace Kps3\Framework\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\Interfaces\ResultInterface;

    abstract class BaseGetOperation extends BaseEntityOperation implements ResultInterface {

      /**
       * The result holder
       * @var mixed
       */
      protected $result;

      protected function doExecute() {
        $select = $this->getTable();
        $this->buildQuery($select);
        $this->buildResult($select->get());
      }

      protected abstract function buildQuery(Builder $select);

      protected abstract function buildResult(array $rows);

      public function GetResult() {
        return $this->result;
      }
    }
  }