<?php
  namespace Kps3\Framework\Operations\Database {

    use Carbon\Carbon;
    use Kps3\Framework\Context\BaseDbContext;
    use Kps3\Framework\Exceptions\InternalException;
    use Kps3\Framework\Interfaces\SoftDeleteMapperInterface;
    use Kps3\Framework\Models\BaseEntity;

    abstract class BaseSoftDeleteOperation extends BaseUpdateOperation {

      public function __construct(BaseDbContext $context, BaseEntity $entity) {
        parent::__construct($context, $entity);
        $this->entity = $entity;
      }

      protected function getFields() {
        return [
          $this->getMapper()->GetDeletedColumnName() => Carbon::now()
        ];
      }

      protected function getMapper() {
        $mapper = parent::getMapper();
        if (!$mapper instanceof SoftDeleteMapperInterface) {
          throw new InternalException('Mapper for ' . $this->entityType . ' must extend BaseSoftDeleteDbMapper.');
        }
        return $mapper;
      }
    }
  }