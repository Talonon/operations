<?php
  namespace Kps3\Framework\Operations\Database {

    abstract class BaseCreateOperation extends BaseEntityOperation {

      protected function doExecute() {
        $id = $this->getTable()->insertGetId(
          $this->getFields()
        );
        $this->entity->SetId($id);
      }

      protected function getFields() {
        return $this->GetMapper()->GetCreateFields($this->entity);
      }
    }
  }