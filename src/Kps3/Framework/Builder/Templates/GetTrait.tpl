<?php
  namespace __NAMESPACE__ {

    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;
    use __OP_NAMESPACE__\Get__MODEL__Operation;

    trait Get__MODEL__Trait {
      /**
       * @param BaseDbContext $context
       * @param int $id
       * @return __MODEL__[]
       */
      private function _get__MODEL__(BaseDbContext $context, $id) {
        $op = new Get__MODEL__Operation($context, $id);
        $op->Execute();
        return $op->GetResult();
      }
    }
  }