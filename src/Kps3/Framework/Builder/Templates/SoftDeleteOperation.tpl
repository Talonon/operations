<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Operations\Database\BaseSoftDeleteOperation;
    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;

    class SoftDelete__MODEL__Operation extends BaseSoftDeleteOperation {
      public function __construct(BaseDbContext $context, __MODEL__ $entity) {
        parent::__construct($context, $entity);
      }
    }
  }