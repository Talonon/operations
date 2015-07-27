<?php
  namespace Kps3\Framework\Operations\Database {

    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseCreateOperation extends BaseEntityOperation {

      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context, get_class($entity));
        $this->entity = $entity;
      }

      protected function doExecute() {
        $id = $this->getTable()->insertGetId(
          $this->getFields()
        );
        $this->entity->SetId($id);
      }

      protected function getFields() {
        return $this->GetMapper()->GetCreateFields($this->entity);
      }
    }
  }