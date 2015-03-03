<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Operations\Database\BaseDeleteOperation;
    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;

    class Delete__MODEL__Operation extends BaseDeleteOperation {
      public function __construct(BaseDbContext $context, __MODEL__ $entity) {
        parent::__construct($context, $entity);
      }
    }
  }