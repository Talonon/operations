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

      /**
       * Gets an instance of the mapper object for the class identified by className.  A Mapper Factory
       * must be configured in the config.php in the project.
       * @param $className
       * @return mixed
       * @throws InternalException
       */
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

      /**
       * Gets the class name from the configuration.  Verifies that it does exist, if it does't throws
       * an Internal Exception.
       * @return mixed
       * @throws InternalException
       */
      public static function GetMapperClassName() {
        $class = \Config::get('framework::mapper.factory');
        if (!$class || !class_exists($class)) {
          throw new InternalException('Mapper Factory Not Found');
        }
        return $class;
      }

    }

  }