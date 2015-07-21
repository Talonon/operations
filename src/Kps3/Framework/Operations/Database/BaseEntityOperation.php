<?php
  namespace Kps3\Framework\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Interfaces\SoftDeleteMapperInterface;
    use Kps3\Framework\Mappers\BaseDbMapper;
    use Kps3\Framework\Mappers\BaseMapperFactory;
    use Kps3\Framework\Mappers\BaseSoftDeleteDbMapper;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseEntityOperation extends BaseDbOperation {
      public function __construct(BaseDbContext $context, $class) {
        parent::__construct($context);
        $this->entityType = $class;
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

      /**
       * @return BaseDbMapper|BaseSoftDeleteDbMapper
       * @throws InternalException
       */
      protected function getMapper() {
        if (!$this->_mapper) {
          $this->_mapper = \App::make($this->entityType . '.Mapper');
        }
        return $this->_mapper;
      }

      /**
       * @return Builder
       */
      protected function getTable() {
        return $this->getDatabase()->table($this->getMapper()->GetTableName());
      }

    }
  }