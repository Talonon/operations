<?php
  namespace Talonon\Operations\Operations\Database {

    use Talonon\Operations\Context\BaseDbContext;
    use Talonon\Operations\Models\BaseEntity;

    abstract class BaseCreateOperation extends BaseEntityOperation {

      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context, get_class($entity));
        $this->entity = $entity;
      }

      protected function doExecute() {
        $method = $this->getMapper()->GetAutoIncrementingID() ? 'insertGetId' : 'insert';
        $id = $this->getTable()->$method(
          $this->getFields()
        );
        $this->getMapper()->GetAutoIncrementingID() && $this->entity->SetId($id);
      }

      protected function getFields() {
        return $this->getMapper()->GetCreateFields($this->entity);
      }
    }
  }