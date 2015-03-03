<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;
    use __OP_NAMESPACE__\SoftDelete__MODEL__Operation;

    trait SoftDelete__MODEL__Trait {
      /**
       * @param BaseDbContext $context
       * @param __MODEL__ $entity
       */
      private function _softDelete__MODEL__(BaseDbContext $context, __MODEL__ $entity) {
        $op = new SoftDelete__MODEL__Operation($context, $entity);
        $op->Execute();
      }
    }
  }