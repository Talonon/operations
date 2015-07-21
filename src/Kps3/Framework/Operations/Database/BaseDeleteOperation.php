<?php
  namespace Kps3\Framework\Operations\Database {

    abstract class BaseDeleteOperation extends BaseEntityOperation {

      protected function doExecute() {
        $this->getTable()->where($this->GetMapper()->GetPrimaryKey(), $this->entity->GetID())->delete();
      }
    }
  }