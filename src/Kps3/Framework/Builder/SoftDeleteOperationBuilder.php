<?php
  namespace Kps3\Framework\Builder {

    class SoftDeleteOperationBuilder extends BaseBuilder {

      protected function getType() {
        return 'Operation';
      }

      protected function getClassNamePrefix() {
        return 'SoftDelete';
      }

      protected function getTemplateFilename() {
        return 'SoftDeleteOperation.tpl';
      }
    }
  }

