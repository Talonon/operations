<?php

  namespace Kps3\Framework\Models {

    use Kps3\Framework\Exceptions\InternalException;

    abstract class Enum {

      public static function IsValue($value) {
        $oc = new \ReflectionClass(get_called_class());
        return in_array($value, $oc->getConstants());
      }

      public static function GetValue($key) {
        $key = strtoupper($key);
        $oc = new \ReflectionClass(get_called_class());
        $constants = $oc->getConstants();
        if (array_key_exists($key, $constants)) {
          return $constants[$key];
        } else {
          throw new InternalException('Invalid enumeration key ' . $key);
        }
      }

      public static function toArray() {
        $oc = new \ReflectionClass(get_called_class());
        return $oc->getConstants();
      }

    }
  }
