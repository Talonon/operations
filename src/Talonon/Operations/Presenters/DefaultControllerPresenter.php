<?php

  namespace Talonon\Operations\Presenters {

    use Talonon\Operations\Controllers\BaseViewController;
    use Talonon\Operations\Controllers\MetadataEnum;

    class DefaultControllerPresenter extends BasePresenter {

      /**
       * @var BaseViewController
       */
      protected $model;

      public function GetTitle() {
        return $this->formatTitle(isset($this->model->GetValue('Metadata')[MetadataEnum::TITLE]) ? $this->model->GetValue('Metadata')[MetadataEnum::TITLE] : \Config::get('kps3framework.metadata.default.title'));
      }


      protected function formatTitle($title) {
        return trim(\Config::get('kps3framework.metadata.title.prefix') . $title . \Config::get('kps3framework.metadata.title.suffix'));
      }
    }

  }
