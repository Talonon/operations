<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;
    use __OP_NAMESPACE__\Delete__MODEL__Operation;

    trait Delete__MODEL__Trait {
      /**
       * @param BaseDbContext $context
       * @param __MODEL__ $entity
       */
      private function _delete__MODEL__(BaseDbContext $context, __MODEL__ $entity) {
        $op = new Delete__MODEL__Operation($context, $entity);
        $op->Execute();
      }
    }
  }