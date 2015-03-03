<?php
  namespace Kps3\Framework\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Mappers\BaseDbMapper;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseEntityOperation extends BaseDbOperation {
      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context);
        $this->entity = $entity;
        $this->entityType = get_class($entity);
      }

      /**
       * @var BaseDbMapper
       */
      private $_mapper;

      /**
       * @var BaseEntity
       */
      protected $entity;

      protected $entityType;

      protected function getMapper() {
        if (!$this->_mapper) {
          $class = \Config::get('framework::config.Mapper.Factory');
          if (!$class || !class_exists($class)) {
            throw new InternalException('Mapper Factory Not Found');
          }
          $this->_mapper = array(\Config::get('Framework::mapper.Factory'), 'GetMapper');
        }
        return $this->_mapper;
      }

      /**
       * @return Builder
       */
      protected
      function getTable() {
        return $this->getDatabase()->table($this->GetMapper()->GetTableName());
      }

    }
  }