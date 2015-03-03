<?php
  namespace Kps3\Framework\Builder {

    class UpdateTraitBuilder extends BaseBuilder {

      protected function getType() {
        return 'Trait';
      }

      protected function getClassNamePrefix() {
        return 'Update';
      }

      protected function getTemplateFilename() {
        return 'UpdateTrait.tpl';
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__OP_NAMESPACE__' => $this->getNamespace('Operation')
        ];
      }
    }
  }

