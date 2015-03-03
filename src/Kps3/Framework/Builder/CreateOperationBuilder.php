<?php
  namespace Kps3\Framework\Builder {

    class CreateOperationBuilder extends BaseBuilder {

      protected function getType() {
        return 'Operation';
      }

      protected function getClassNamePrefix() {
        return 'Create';
      }

      protected function getTemplateFilename() {
        return 'CreateOperation.tpl';
      }


    }
  }

