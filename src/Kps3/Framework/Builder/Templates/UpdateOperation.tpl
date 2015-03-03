<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Operations\Database\BaseUpdateOperation;
    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;

    class Update__MODEL__Operation extends BaseUpdateOperation {
      public function __construct(BaseDbContext $context, __MODEL__ $entity) {
        parent::__construct($context, $entity);
      }
    }
  }