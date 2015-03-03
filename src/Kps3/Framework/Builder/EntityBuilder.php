<?php


  namespace Kps3\Framework\Builder {

    class EntityBuilder extends BaseBuilder {

      public static $IgnoreProperties = ['created_date', 'modified_date', 'name', 'id'];

      protected function getType() {
        return 'Model';
      }

      protected function getClassName() {
        return self::getConfig('name');
      }

      protected function getClassNamePrefix() {
        return '';
      }

      protected function getTemplateFilename() {
        return 'Entity.tpl';
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__BODY__'           => $this->_buildBody(),
          '__IMPLEMENTS__'     => self::getConfig('softDelete') ? ' implements SoftDeletableEntityInterface' : '',
          '__IMPLEMENTS_USE__' => self::getConfig('softDelete') ? 'use \Kps3\Framework\Interfaces\SoftDeletableEntityInterface;' : '',
        ];
      }

      private function _buildBody() {
        $body = '';
        $properties = $this->_getProperties();
        $body = $this->_buildProperties($properties);
        $body = $body .= ($body ? "\n" : '');
        $body .= $this->_buildMethods($properties);
        return $body;
      }

      private function _buildProperties($properties) {
        $result = '';
        $template = file_get_contents(dirname(__FILE__) . '/Templates/Entity-Property.tpl');
        for ($x = 0, $c = count($properties); $x < $c; $x++) {
          $templateCopy = $template;
          $result .= str_replace(
            [
              '__PROPERTY__',
              '__property__'],
            [ucfirst(\Str::camel($properties[$x])),
              lcfirst(\Str::camel($properties[$x]))]
            , $templateCopy);
        }
        return $result;
      }

      private function _buildMethods($properties) {
        $templates = ['get' => file_get_contents(dirname(__FILE__) . '/Templates/Entity-GetMethod.tpl'),
                      'set' => file_get_contents(dirname(__FILE__) . '/Templates/Entity-SetMethod.tpl')];
        $result = '';
        for ($x = 0, $c = count($properties); $x < $c; $x++) {
          foreach ($templates as $template) {
            $result .= str_replace(
              [
                '__PROPERTY__',
                '__property__'],
              [ucfirst(\Str::camel($properties[$x])),
                lcfirst(\Str::camel($properties[$x]))]
              , $template);
          }
        }
        return $result;
      }

      private function _getProperties() {
        $properties = [];
        if (self::getConfig('softDelete')) {
          $properties[] = self::getConfig('softDeleteColumn');
          self::$IgnoreProperties[] = self::getConfig('softDeleteColumn');
        }
        if (self::getConfig('auto-build')) {
          self::$IgnoreProperties[] = self::getConfig('primaryKey');
          $columns = \Schema::getColumnListing(self::getConfig('table'));
          for ($x = 0, $c = count($columns); $x < $c; $x++) {
            $column = $columns[$x];
            if (in_array($column, self::$IgnoreProperties)) continue;
            $properties[] = $column;
          }
        }
        return $properties;
      }
    }
  }
