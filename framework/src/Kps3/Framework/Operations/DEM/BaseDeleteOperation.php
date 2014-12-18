<?php
  namespace Kps3\Framework\Operations\DEM {

    abstract class BaseDeleteOperation extends BaseEntityOperation {

      protected function DoExecute() {
        $this->getTable()->where($this->mapper->GetPrimaryKey(), $this->entity->GetID())->delete();
      }
    }
  }