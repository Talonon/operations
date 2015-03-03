<?php
  namespace Kps3\Framework\Operations\Database {

    abstract class BaseCreateOperation extends BaseEntityOperation {

      protected function DoExecute() {
        $id = $this->getTable()->insertGetId(
          $this->mapper->GetCreateFields($this->entity)
        );
        $this->entity->SetId($id);
      }

    }
  }