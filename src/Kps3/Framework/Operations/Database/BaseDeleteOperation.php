<?php
  namespace Kps3\Framework\Operations\Database {

    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseDeleteOperation extends BaseEntityOperation {

      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context, get_class($entity));
        $this->entity = $entity;
      }

      protected function doExecute() {
        $this->getTable()->where($this->GetMapper()->GetPrimaryKey(), $this->entity->GetID())->delete();
      }
    }
  }