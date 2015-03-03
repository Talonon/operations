<?php
  namespace Kps3\Framework\Builder {

    class SoftDeleteTraitBuilder extends BaseBuilder {

      protected function getType() {
        return 'Trait';
      }

      protected function getClassNamePrefix() {
        return 'SoftDelete';
      }

      protected function getTemplateFilename() {
        return 'SoftDeleteTrait.tpl';
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__OP_NAMESPACE__' => $this->getNamespace('Operation')
        ];
      }
    }
  }

