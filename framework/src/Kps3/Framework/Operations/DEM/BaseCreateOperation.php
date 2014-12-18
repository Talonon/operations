<?php
  namespace Kps3\Framework\Operations\DEM {

    abstract class BaseCreateOperation extends BaseEntityOperation {

      protected function DoExecute() {
        $id = $this->getTable()->insertGetId(
          $this->mapper->GetCreateFields($this->entity)
        );
        $this->entity->SetId($id);
      }

    }
  }