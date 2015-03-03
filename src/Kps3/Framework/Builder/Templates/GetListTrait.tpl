<?php
  namespace __NAMESPACE__ {

    use Illuminate\Support\Collection;
    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;
    use __OP_NAMESPACE__\Get__MODELS__Operation;
    use __SEARCH_PARAMS_NAMESPACE__;

    trait Get__MODELS__Trait {
      /**
       * @param BaseDbContext $context
       * @param __MODEL__SearchParams $params
       * @return __MODEL__[]|Collection
       */
      private function _get__MODELS__(BaseDbContext $context, __MODEL__SearchParams $params) {
        $op = new Get__MODELS__Operation($context, $params);
        $op->Execute();
        return $op->GetResult();
      }
    }
  }