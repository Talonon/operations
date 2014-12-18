<?php

  namespace Kps3\Framework\DEM\Mappers {

    abstract class BaseMapperFactory {

      /**
       * @param $className
       * @return BaseMapper
       */
      abstract function GetMapper($className);

    }

  }