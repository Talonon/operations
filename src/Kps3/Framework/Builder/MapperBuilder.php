<?php


  namespace Kps3\Framework\Builder {

    class MapperBuilder extends BaseBuilder {

      public static $IgnoreProperties = ['created_date', 'modified_date', 'id'];


      protected function getType() {
        return 'Mapper';
      }

      protected function getClassName() {
        return self::getConfig('name') . $this->getType();
      }

      protected function getClassNamePrefix() {
        return '';
      }

      protected function getTemplateFilename() {
        return 'Mapper.tpl';
      }

      protected function usesEntityNamespace() {
        return false;
      }

      protected function getTemplateData() {
        return parent::getTemplateData() + [
          '__FIELDS__'         => $this->_buildFields(),
          '__IMPLEMENTS__'     => self::getConfig('softDelete') ? ' implements SoftDeleteMapperInterface' : '',
          '__IMPLEMENTS_USE__' => self::getConfig('softDelete') ? 'use \Kps3\Framework\Interfaces\SoftDeleteMapperInterface;' : '',
          '__DELETED_METHOD__' => self::getConfig('softDelete') ? $this->_getDeleteMethod() : '',
          '__TABLE__'          => self::getConfig('table'),
          '__PRIMARY__'        => self::getConfig('primaryKey'),
          '__SETTERS__'        => $this->_buildSetters(),
        ];
      }

      private function _getDeleteMethod() {
        $template = file_get_contents(dirname(__FILE__) . '/Templates/Mapper-DeleteMethod.tpl');
        return str_replace(
          '__DELETE_COLUMN_NAME__',
          self::getConfig('softDeleteColumn')
          , $template);
      }

      private function _buildFields() {
        $properties = $this->_getProperties();
        $result = '';
        $template = file_get_contents(dirname(__FILE__) . '/Templates/Mapper-Field.tpl');
        for ($x = 0, $c = count($properties); $x < $c; $x++) {
          $templateCopy = $template;
          $result .= str_replace(
            [
              '__METHOD__',
              '__FIELD__'],
            [ucfirst(\Str::camel($properties[$x])),
              lcfirst(\Str::camel($properties[$x]))]
            , $templateCopy);
        }
        return $result;
      }

      private function _buildSetters() {
        $properties = $this->_getProperties();
        $result = '';
        $template = file_get_contents(dirname(__FILE__) . '/Templates/Mapper-Setter.tpl');
        for ($x = 0, $c = count($properties); $x < $c; $x++) {
          $templateCopy = $template;
          $result .= str_replace(
            [
              '__METHOD__',
              '__FIELD__'],
            [ucfirst(\Str::camel($properties[$x])),
              lcfirst(\Str::camel($properties[$x]))]
            , $templateCopy);
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
