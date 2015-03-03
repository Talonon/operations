<?php
  namespace Kps3\Framework\Builder {

    use Illuminate\Support\Pluralizer;

    class GetListTraitBuilder extends BaseBuilder {

      protected function getType() {
        return 'Trait';
      }

      protected function getClassName() {
        return $this->getClassNamePrefix() . Pluralizer::plural(self::getConfig('name')) . $this->getType();
      }

      protected function getClassNamePrefix() {
        return 'Get';
      }

      protected function getTemplateFilename() {
        return 'GetListTrait.tpl';
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__OP_NAMESPACE__' => $this->getNamespace('Operation'),
          '__SEARCH_PARAMS_NAMESPACE__' => $this->getNamespace('Model') . '\\' . self::getConfig('name') . 'SearchParams',
          '__MODELS__' => Pluralizer::plural(self::getConfig('name'))
        ];
      }
    }
  }

