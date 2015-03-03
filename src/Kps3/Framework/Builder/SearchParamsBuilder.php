<?php


namespace Kps3\Framework\Builder {

  class SearchParamsBuilder extends BaseBuilder {
    protected function getType() {
      return 'Model';
    }

    protected function doBuild($fs) {

    }

    protected function getClassName() {
      return self::getConfig('name') . 'SearchParams';
    }

    protected function getClassNamePrefix() {
      return '';
    }

    protected function getTemplateFilename() {
      return 'SearchParams.tpl';
    }
  }

}
