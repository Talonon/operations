<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Operations\Database\BaseCreateOperation;
    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;

    class Create__MODEL__Operation extends BaseCreateOperation {
      public function __construct(BaseDbContext $context, __MODEL__ $entity) {
        parent::__construct($context, $entity);
      }
    }
  }