<?php
  namespace Kps3\Framework\Operations\Database {

    abstract class BaseDeleteOperation extends BaseEntityOperation {

      protected function DoExecute() {
        $this->getTable()->where($this->mapper->GetPrimaryKey(), $this->entity->GetID())->delete();
      }
    }
  }