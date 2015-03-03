<?php
  namespace Kps3\Framework\Operations\Database {

    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseUpdateOperation extends BaseEntityOperation {

      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context, $entity);
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