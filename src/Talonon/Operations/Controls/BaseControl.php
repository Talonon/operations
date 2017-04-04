<?php namespace Talonon\Operations\Controls;

use Talonon\Operations\Context\BaseContext;
use Tix\Admin\Internals\Models\Contexts\AnonymousContext;
use Tix\Data\Contexts\TixContext;

abstract class BaseControl {

  public function __construct($value = null) {
    $value && $this->SetValue($value);
    $this->context = app('Context');
  }

  protected $template = "";
  protected $label = null;
  protected $name = null;
  protected $class = null;
  /**
   * @var BaseContext|TixContext|AnonymousContext
   */
  protected $context;
  private $_value;
  private $_id;

  /**
   * Loads the data from the request().  Not meant to be called by user code, it is called when the control is
   * added to a controller
   * @return $this
   */
  public function LoadInputs() {
    $this->SetValue($this->getValueFromInput());
    return $this;
  }

  public final function render() {
    return view()->make(
      'Controls::' . $this->template, [
                                      'value' => $this->_value,
                                      'label' => $this->label,
                                      'name'  => $this->name,
                                      'class' => $this->class
                                    ] + $this->getRenderData())->render();
  }

  /**
   * @param null $label
   * @return BaseControl
   */
  public function SetLabel($label) {
    $this->label = $label;
    return $this;
  }

  /**
   * @param null $name
   * @return BaseControl
   */
  public function SetName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @param null $class
   * @return BaseControl
   */
  public function SetClass($class) {
    $this->class = $class;
    return $this;
  }

  /**
   * @return mixed
   */
  public function GetId() {
    return $this->_id;
  }

  /**
   * @param mixed $id
   * @return $this
   */
  public function SetId($id) {
    $this->_id = $id;
    return $this;
  }

  /**
   * @return null
   */
  public function GetValue() {
    return $this->_value;
  }

  /**
   * @param null $value
   * @return mixed
   */
  public function SetValue($value) {
    $this->_value = $value;
    return $this;
  }

  /**
   * To pass more data to the view, the implementor should override this method.
   * @return array
   */
  protected function getRenderData(): array {
    return [];
  }

  /**
   * @return mixed
   */
  protected function getValueFromInput() {

  }
}