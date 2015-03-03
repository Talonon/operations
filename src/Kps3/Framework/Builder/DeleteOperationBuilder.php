<?php
  namespace Kps3\Framework\Builder {

    class DeleteOperationBuilder extends BaseBuilder {

      protected function getType() {
        return 'Operation';
      }

      protected function getClassNamePrefix() {
        return 'Delete';
      }

      protected function getTemplateFilename() {
        return 'DeleteOperation.tpl';
      }
    }
  }

