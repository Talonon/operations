<?php
  namespace Kps3\Framework\Operations\DEM {

    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\DEM\Context\BaseDbContext;
    use Kps3\Framework\DEM\Mappers\BaseMapper;
    use Kps3\Framework\Models\DEM\BaseEntity;

    abstract class BaseEntityOperation extends BaseDbOperation {
      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context);
        $this->entity = $entity;
        $this->entityType = get_class($entity);
        // @TODO Mapper
      }

      /**
       * @var BaseMapper
       */
      protected $mapper;

      /**
       * @var BaseEntity
       */
      protected $entity;

      protected $entityType;

      /**
       * @return Builder
       */
      protected function getTable() {
        return $this->getDatabase()->table($this->mapper->GetTableName());
      }

    }
  }