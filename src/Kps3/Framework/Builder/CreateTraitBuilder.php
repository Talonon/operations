<?php
  namespace Kps3\Framework\Builder {

    class CreateTraitBuilder extends BaseBuilder {

      protected function getType() {
        return 'Trait';
      }

      protected function getClassNamePrefix() {
        return 'Create';
      }

      protected function getTemplateFilename() {
        return 'CreateTrait.tpl';
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__OP_NAMESPACE__' => $this->getNamespace('Operation')
        ];
      }
    }
  }

