<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Operations\Database\BaseGetSingleOperation;
    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;

    class Get__MODEL__Operation extends BaseGetSingleOperation {
      public function __construct(BaseDbContext $context, $id) {
        parent::__construct($context, $id, new __MODEL__());
      }
    }
  }