<?php
  namespace Kps3\Framework\Controllers {

    use Carbon\Carbon;
    use Illuminate\Routing\Controller;
    use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

    abstract class BaseController extends Controller {

      protected function getString($key, $required = false) {
        return $this->_get($key, $required, function($key) {
          return \Input::get($key);
        });
      }

      protected function getInt($key, $required = false) {
        return $this->_get($key, $required, function($key) {
          $input = \Input::get($key);
          if ($input == null) return null;
          $val = intval($input, 10);
          if (is_numeric($input) && $val == $input) {
            return $val;
          } else {
            $this->_invalidFormat($key);
          }
        });
      }

      protected function getFloat($key, $required = false) {
        return $this->_get($key, $required, function($key) {
          $input = \Input::get($key);
          if ($input == null) return null;
          $val = floatval($input);
          if (is_numeric($input) && $val == $input) {
            return $val;
          } else {
            $this->_invalidFormat($key);
          }
        });
      }

      protected function getBoolean($key, $required = false) {
        return $this->_get(
          $key, $required, function ($key) {
          $input = \Input::get($key);
          if ($input == null) return null;
          $input = strtolower($input);
          switch ($input) {
            case 1:
            case '1':
            case 'true':
            case 'on':
            case 'yes':
            case 'y':
              return true;
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
        });
      }

      /**
       * @param $key
       * @param bool $required
       * @return Carbon|null
       */
      protected function getDateTime($key, $format = null, $tz = null, $required = false) {
        return $this->_get($key, $required, function($key) use ($format, $tz) {
          $input = \Input::get($key);
          return $input ? ($format ? Carbon::createFromFormat($format, $input) : Carbon::parse($input, $tz)) : null;
        });
      }

      private function _badRequest($key) {
        throw new BadRequestHttpException($key . ' is required');
      }

      private function _invalidFormat($key) {
        throw new \InvalidArgumentException($key);
      }

      private function _get($key, $required, Callable $callback) {
        if ($required && !\Input::has($key)) {
          $this->_badRequest($key);
        }
        return $callback($key, $required);
      }
    }

  }