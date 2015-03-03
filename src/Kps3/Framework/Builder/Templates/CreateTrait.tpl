<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;
    use __OP_NAMESPACE__\Create__MODEL__Operation;

    trait Create__MODEL__Trait {
      /**
       * @param BaseDbContext $context
       * @param __MODEL__ $entity
       */
      private function _create__MODEL__(BaseDbContext $context, __MODEL__ $entity) {
        $op = new Create__MODEL__Operation($context, $entity);
        $op->Execute();
      }
    }
  }