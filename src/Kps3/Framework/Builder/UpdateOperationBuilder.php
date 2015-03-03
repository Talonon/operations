<?php
  namespace Kps3\Framework\Builder {

    class UpdateOperationBuilder extends BaseBuilder {

      protected function getType() {
        return 'Operation';
      }

      protected function getClassNamePrefix() {
        return 'Update';
      }

      protected function getTemplateFilename() {
        return 'UpdateOperation.tpl';
      }
    }
  }

