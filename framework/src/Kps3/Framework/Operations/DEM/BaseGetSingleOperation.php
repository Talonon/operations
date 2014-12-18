<?php
  namespace Kps3\Framework\Operations\DEM {
    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\DEM\Context\BaseDbContext;
    use Kps3\Framework\Exceptions\NotFoundException;
    use Kps3\Framework\Models\DEM\BaseEntity;

    abstract class BaseGetSingleOperation extends BaseGetOperation {

      public function __construct(BaseDbContext $context, $id, BaseEntity $entity) {
        parent::__construct($context, $entity);
        $this->id = $id;
      }

      protected $id;

      protected function buildQuery(Builder $select) {
        $select->where($this->mapper->GetTableName() . '.' . $this->mapper->GetPrimaryKey(), $this->id);
      }

      protected function buildResult(array $rows) {
        if (count($rows) == 0) {
          throw new NotFoundException($this->entityType, $this->id);
        }
        $this->result = $this->mapper->BuildSingle($rows[0]);
      }
    }
  }