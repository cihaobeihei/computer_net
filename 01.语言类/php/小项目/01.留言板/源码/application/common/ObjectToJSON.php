<?php
namespace app\common;

class ObjectToJSON{
    public static function toJSON($array) {
//         if(is_object($array)) {
//             $array = (array)$array;
//         } if(is_array($array)) {
//             foreach($array as $key=>$value) {
//                 $array[$key] = static::toJSON($value);
//             }
//         }
        return json_encode($array);
    }
}
