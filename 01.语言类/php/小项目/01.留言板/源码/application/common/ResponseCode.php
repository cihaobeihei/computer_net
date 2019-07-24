<?php
namespace app\common;

class ResponseCode{
    private static $SUCCESSCODE = 0;
    private static $SUCCESSDESC = "SUCCESS";
    private static $ERRORCODE = 1;
    private static $ERRORDESC = "FAILD";
    
    private function __construct(){}
    public static function getSuccessCode() {
        return ResponseCode::$SUCCESSCODE;
    }
    public static function getSuccessDesc() {
        return ResponseCode::$SUCCESSDESC;
    }
    public static function getErrorCode() {
        return ResponseCode::$ERRORCODE;
    }
    public static function getErrorDesc() {
        return ResponseCode::$ERRORDESC;
    }
}