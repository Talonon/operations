<?php

  namespace Kps3\Framework\Mappers {

    use Kps3\Framework\Exceptions\InternalException;

    abstract class BaseMapperFactory {

      private static $_mapper;

      /**
       * @param $className
       * @return BaseMapper
       */
      abstract protected function doGetMapper($className);

      public static function GetMapper($className) {
        if (!self::$_mapper) {
          self::$_mapper = new static();
        }
        $mapper = self::$_mapper->doGetMapper($className);
        if (!$mapper) {
          throw new InternalException('No Mapper found for ' . $className);
        }
        return $mapper;
      }

    }

  }