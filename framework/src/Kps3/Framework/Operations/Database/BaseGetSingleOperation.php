<?php
  namespace Kps3\Framework\Operations\Database {
    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Exceptions\EntityNotFoundException;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseGetSingleOperation extends BaseGetOperation {

      public function __construct(BaseDbContext $context, $id, BaseEntity $entity) {
        parent::__construct($context, $entity);
        $this->id = $id;
      }

      /**
       * @var int
       */
      protected $id;

      protected function buildQuery(Builder $select) {
        $select->where($this->mapper->GetTableName() . '.' . $this->mapper->GetPrimaryKey(), $this->id);
      }

      protected function buildResult(array $rows) {
        if (count($rows) == 0) {
          throw new EntityNotFoundException($this->entityType, $this->id);
        }
        $this->result = $this->mapper->BuildSingle($rows[0]);
      }
    }
  }