<?php namespace Talonon\Operations\Controllers;

use Illuminate\Support\Collection;
use Talonon\Operations\Controls\BaseControl;

trait HasControls {
  /**
   * @param string $name
   * @param BaseControl $control
   */
  protected function addControl(string $name, BaseControl $control) {
    /** @var Collection $controls */
    $controls = app('App.Views.Controls');
    $controls->put($name, $control->SetName($name)->LoadInputs());
  }

  /**
   * @param $name
   * @return BaseControl
   */
  protected function getControl($name) {
    /** @var Collection $controls */
    $controls = app('App.Views.Controls');
    return $controls->get($name, null);
  }
}

