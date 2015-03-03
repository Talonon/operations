<?php
  namespace __NAMESPACE__ {

    use Illuminate\Database\Query\Builder;
    use \Kps3\Framework\Operations\Database\BaseGetMultipleOperation;
    use \Kps3\Framework\Context\BaseDbContext;
    use __MODEL_NAMESPACE__;
    use __SEARCH_PARAMS_NAMESPACE__;

    class Get__MODELS__Operation extends BaseGetMultipleOperation {
      public function __construct(BaseDbContext $context, __MODEL__SearchParams $params) {
        parent::__construct($context, $params, new __MODEL__());
      }

      protected function buildQuery(Builder $builder) {
        parent::buildQuery($builder);
        /** SearchParams Logic Goes Here **/
      }
    }
  }