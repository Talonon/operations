<?php
  namespace Kps3\Framework\Controllers {

    use Carbon\Carbon;
    use Illuminate\Routing\Controller;
    use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

    abstract class BaseController extends Controller {

      protected function getString($key, $required = false) {
        $this->_requiredCheck($key, $required);
        return \Input::get($key);
      }

      protected function getInt($key, $required = false) {
        $this->_requiredCheck($key, $required);
        $input = \Input::get($key);
        $val = intval($input, 10);
        if (is_numeric($input) && $val == $input) {
          return $val;
        } else {
          $this->_invalidFormat($key);
        }
      }

      protected function getFloat($key, $required = false) {
        $this->_requiredCheck($key, $required);
        $input = \Input::get($key);
        $val = floatval($input);
        if (is_numeric($input) && $val == $input) {
          return $val;
        } else {
          $this->_invalidFormat($key);
        }
      }

      protected function getBoolean($key, $required = false) {
        $this->_requiredCheck($key, $required);
        $input = \Input::get($key);
        $input = strtolower($input);
        switch ($input) {
          case $input == true:
          case $input == 1:
          case 'true':
          case 'on':
          case 'yes':
          case 'y':
            return true;
            break;
          case $input === 0:
          case $input === '0':
          case 'false':
          case 'off':
          case 'no':
          case 'n':
            return false;
          default:
            $this->_invalidFormat($key);
        }
      }

      /**
       * @param $key
       * @param bool $required
       * @return Carbon|null
       */
      protected function getDateTime($key, $format = null, $tz = null, $required = false) {
        $this->_requiredCheck($key, $required);
        $input = \Input::get($key);
        return $input ? ($format ? Carbon::createFromFormat($format, $input) : Carbon::parse($input, $tz)) : null;
      }

      private function _badRequest($key) {
        throw new BadRequestHttpException($key . ' is required');
      }

      private function _invalidFormat($key) {
        throw new \InvalidArgumentException($key);
      }

      private function _requiredCheck($key, $required) {
        if ($required && !\Input::has($key)) {
          $this->_badRequest($key);
        }
      }
    }

  }