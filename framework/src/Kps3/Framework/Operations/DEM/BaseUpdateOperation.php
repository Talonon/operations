<?php
  namespace Kps3\Framework\Operations\DEM {

    use Kps3\Framework\DEM\Context\BaseDbContext;
    use Kps3\Framework\Models\DEM\BaseEntity;

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
             ->where($this->mapper->GetPrimaryKey(), $this->entity->GetId())
             ->update($this->mapper->GetUpdateFields($this->entity));
      }
    }
  }