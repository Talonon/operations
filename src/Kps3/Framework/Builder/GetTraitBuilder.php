<?php
  namespace Kps3\Framework\Builder {

    class GetTraitBuilder extends BaseBuilder {

      protected function getType() {
        return 'Trait';
      }

      protected function getClassNamePrefix() {
        return 'Get';
      }

      protected function getTemplateFilename() {
        return 'GetTrait.tpl';
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__OP_NAMESPACE__' => $this->getNamespace('Operation')
        ];
      }
    }
  }

