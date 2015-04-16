<?php
  namespace Kps3\Framework\Operations\Database {

    use Illuminate\Database\Query\Builder;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Interfaces\SoftDeleteMapperInterface;
    use Kps3\Framework\Mappers\BaseDbMapper;
    use Kps3\Framework\Mappers\BaseMapperFactory;
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
      private static $_mapper;

      /**
       * @var BaseEntity
       */
      protected $entity;

      protected $entityType;

      /**
       * @return BaseDbMapper|SoftDeleteMapperInterface
       * @throws InternalException
       */
      protected function getMapper() {
        if (!self::$_mapper) {
          $mapper = \App::make($this->entityType . '.Mapper');
          if (!$mapper instanceof SoftDeleteMapperInterface) {
            throw new InternalException('Mapper for ' . $this->entityType . ' must implement SoftDeleteMapperInterface.');
          }
          self::$_mapper = $mapper;
        }
        return self::$_mapper;
      }

      /**
       * @return Builder
       */
      protected function getTable() {
        return $this->getDatabase()->table($this->getMapper()->GetTableName());
      }

    }
  }