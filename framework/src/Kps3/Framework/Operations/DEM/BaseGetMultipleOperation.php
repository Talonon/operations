<?php
  namespace Kps3\Framework\Operations\DEM {

    use Kps3\Framework\DEM\Context\BaseDbContext;
    use Kps3\Framework\Models\BaseSearchParams;

    abstract class BaseGetMultipleOperation extends BaseGetOperation {

      public function __construct(BaseDbContext $context, BaseSearchParams $params = null, $entityType) {
        parent::__construct($context, $entityType);
        $this->params = $params;
      }

      /**
       * @var BaseSearchParams
       */
      protected $params;

      protected function doExecute() {
        $select = $this->getTable();
        $this->buildQuery($select);
        $this->buildResult($select->get());
      }

      protected function buildResult(array $rows) {
        $result = [];
        for ($x = 0, $c = count($rows); $x < $c; $x++) {
          $result[] = $this->mapper->BuildMultiple($rows[$x]);
        }
        $this->result = $result;
      }

    }
  }