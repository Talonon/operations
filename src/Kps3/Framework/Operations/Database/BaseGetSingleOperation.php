<?php
  namespace Kps3\Framework\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Exceptions\EntityNotFoundException;
    use Kps3\Framework\Mappers\BaseSoftDeleteDbMapper;

    abstract class BaseGetSingleOperation extends BaseGetOperation {

      public function __construct(BaseDbContext $context, $id, $class) {
        parent::__construct($context, $class);
        $this->id = $id;
      }

      /**
       * @var int
       */
      protected $id;

      protected function buildQuery(Builder $select) {
        $select->where($this->GetMapper()->GetTableName() . '.' . $this->GetMapper()->GetPrimaryKey(), $this->id);
        if ($this->getMapper() instanceof BaseSoftDeleteDbMapper) {
          $select->whereNull($this->getMapper()->GetDeletedColumnName());
        }
      }

      protected function buildResult() {
        if (count($this->rows) == 0) {
          throw new EntityNotFoundException($this->entityType, $this->id);
        }
        $row = $this->rows[0];
        $this->result = $this->GetMapper()->BuildSingle(is_object($row) ? get_object_vars($row) : $row);
        unset($this->rows);
      }
    }
  }