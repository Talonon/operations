<?php
  namespace Kps3\Framework\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Mappers\BaseDbMapper;
    use Kps3\Framework\Mappers\BaseMapper;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseEntityOperation extends BaseDbOperation {
      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context);
        $this->entity = $entity;
        $this->entityType = get_class($entity);
        // @TODO Mapper
      }

      /**
       * @var BaseDbMapper
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