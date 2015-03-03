<?php

  namespace Kps3\Framework\Mappers {

    abstract class BaseMapperFactory {

      /**
       * @param $className
       * @return BaseMapper
       */
      abstract function GetMapper($className);

    }

  }