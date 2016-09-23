<?php
  namespace Talonon\Operations\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Talonon\Operations\Context\BaseDbContext;
    use Talonon\Operations\Exceptions\EntityNotFoundException;
    use Talonon\Operations\Mappers\BaseSoftDeleteDbMapper;

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
        $pk = $this->getMapper()->GetPrimaryKey();
        if (is_array($pk)) {
          $select->where(
            function (Builder $inner) use ($pk) {
              for ($x = 0, $c = count($pk); $x < $c; $x++) {
                $inner->where($this->getMapper()->GetTableName() . '.' . $pk[$x], $this->id[$x] ?? null);
              }
            });
        } else {
          $select->where($this->getMapper()->GetTableName() . '.' . $this->getMapper()->GetPrimaryKey(), $this->id);
        }
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