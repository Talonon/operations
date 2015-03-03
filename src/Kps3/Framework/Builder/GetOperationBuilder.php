<?php
  namespace Kps3\Framework\Builder {

    class GetOperationBuilder extends BaseBuilder {

      protected function getType() {
        return 'Operation';
      }

      protected function getClassNamePrefix() {
        return 'Get';
      }

      protected function getTemplateFilename() {
        return 'GetOperation.tpl';
      }
    }
  }

