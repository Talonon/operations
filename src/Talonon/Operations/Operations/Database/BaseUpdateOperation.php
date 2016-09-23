<?php
  namespace Talonon\Operations\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Talonon\Operations\Context\BaseDbContext;
    use Talonon\Operations\Models\BaseEntity;

    abstract class BaseUpdateOperation extends BaseEntityOperation {

      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context, get_class($entity));
        $this->entity = $entity;
      }

      /**
       * @var BaseEntity
       */
      protected $entity;

      protected function doExecute() {
        $table = $this->getTable();
        $pk = $this->getMapper()->GetPrimaryKey();
        if (is_array($pk)) {
          $table->where(
            function (Builder $inner) use ($pk) {
              $id = $this->entity->GetId();
              for ($x = 0, $c = count($pk); $x < $c; $x++) {
                $inner->where($this->getMapper()->GetTableName() . '.' . $pk[$x], $id[$x] ?? null);
              }
            });
        } else {
          $table->where($this->getMapper()->GetTableName() . '.' . $this->getMapper()->GetPrimaryKey(), $this->entity->GetId());
        }
        $table->update($this->getFields());
      }

      protected function getFields() {
        return $this->getMapper()->GetUpdateFields($this->entity);
      }
    }
  }