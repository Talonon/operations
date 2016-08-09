<?php
  namespace Talonon\Operations\Operations\Database {

    use Carbon\Carbon;
    use Talonon\Operations\Context\BaseDbContext;
    use Talonon\Operations\Exceptions\InternalException;
    use Talonon\Operations\Interfaces\SoftDeleteMapperInterface;
    use Talonon\Operations\Models\BaseEntity;

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