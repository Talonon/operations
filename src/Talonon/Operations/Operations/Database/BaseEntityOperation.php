<?php
  namespace Talonon\Operations\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Talonon\Operations\Context\BaseDbContext;
    use Talonon\Operations\Exceptions\InternalException;
    use Talonon\Operations\Interfaces\SoftDeleteMapperInterface;
    use Talonon\Operations\Mappers\BaseDbMapper;
    use Talonon\Operations\Mappers\BaseMapperFactory;
    use Talonon\Operations\Mappers\BaseSoftDeleteDbMapper;
    use Talonon\Operations\Models\BaseEntity;

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