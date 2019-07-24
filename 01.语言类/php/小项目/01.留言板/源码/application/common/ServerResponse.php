<?php
namespace app\common;
use app\common\ResponseCode;
use JsonSerializable;
class ServerResponse implements  JsonSerializable{
    private $code = null;
    private $data = null;
    private function __construct($code, $data) {
        $this->code = $code;
        $this->data = $data;
    }
    
    public static function createBySuccess() {
        return new ServerResponse(ResponseCode::getSuccessCode(), null);
    }
    public static function createBySuccessMessage($data) {
        return new ServerResponse(ResponseCode::getSuccessCode(),$data);
    }
    public static function createByError() {
        return new ServerResponse(ResponseCode::getErrorCode(), null);
    }
    public static function createByErrorMessage($data) {
        return new ServerResponse(ResponseCode::getErrorCode(),$data);
    }
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'data' => $this->data
        ];
    }

}