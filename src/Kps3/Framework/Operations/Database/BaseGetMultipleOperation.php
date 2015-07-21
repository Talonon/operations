<?php
  namespace Kps3\Framework\Operations\Database {

    use Illuminate\Database\Eloquent\SoftDeletingTrait;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Collection;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Interfaces\SoftDeletableEntityInterface;
    use Kps3\Framework\Mappers\BaseSoftDeleteDbMapper;
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

      /**
       * @return Collection
       */
      public function GetResult() {
        return $this->result;
      }

      protected function buildQuery(Builder $builder) {
        if ($this->entity instanceof BaseSoftDeleteDbMapper) {
          $builder->whereNull($this->getMapper()->GetDeletedColumnName());
        }
      }

      protected function doExecute() {
        $select = $this->getTable();
        $this->buildQuery($select);
        $this->buildResult($select->get());
      }

      protected function buildResult(array $rows) {
        $result = new Collection();
        $mapper = $this->GetMapper();
        for ($x = 0, $c = count($rows); $x < $c; $x++) {
          $result[] = $mapper->BuildMultiple($rows[$x]);
        }
        $this->result = $result;
      }
    }
  }