<?php

  namespace Kps3\Framework\Context {

    abstract class BaseDbContext extends BaseContext {

      public function GetDatabase() {
        return \DB::connection();
      }

    }

  }