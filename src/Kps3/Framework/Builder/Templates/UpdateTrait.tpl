<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;
    use __OP_NAMESPACE__\Update__MODEL__Operation;

    trait Update__MODEL__Trait {
      /**
       * @param BaseDbContext $context
       * @param __MODEL__ $entity
       */
      private function _update__MODEL__(BaseDbContext $context, __MODEL__ $entity) {
        $op = new Update__MODEL__Operation($context, $entity);
        $op->Execute();
      }
    }
  }