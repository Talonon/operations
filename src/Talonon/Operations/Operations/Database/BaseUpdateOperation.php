<?php
  namespace Talonon\Operations\Operations\Database {

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
        $this->getTable()
             ->where($this->GetMapper()->GetPrimaryKey(), $this->entity->GetId())
             ->update($this->getFields());
      }

      protected function getFields() {
        return $this->GetMapper()->GetUpdateFields($this->entity);
      }
    }
  }