<?php

  namespace Talonon\Operations\Context {

    abstract class BaseDbContext extends BaseContext {

      public function GetDatabase() {
        return \DB::connection();
      }

    }

  }