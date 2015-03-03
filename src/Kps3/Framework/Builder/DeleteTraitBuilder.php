<?php
  namespace Kps3\Framework\Builder {

    class DeleteTraitBuilder extends BaseBuilder {

      protected function getType() {
        return 'Trait';
      }

      protected function getClassNamePrefix() {
        return 'Delete';
      }

      protected function getTemplateFilename() {
        return 'DeleteTrait.tpl';
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__OP_NAMESPACE__' => $this->getNamespace('Operation')
        ];
      }
    }
  }

