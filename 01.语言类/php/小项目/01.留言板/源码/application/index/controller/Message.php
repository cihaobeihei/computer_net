<?php
namespace app\index\controller;

use think\Session;
use app\common\MyConst;
use app\common\ServerResponse;
use app\index\model\MessageService;
use app\common\ObjectToJSON;

class Message{
    private $iMessageService = null;

    public function __construct(){
        $this->iMessageService = new MessageService();
    }

    public function add($boardId, $content){
        $user = Session::get(MyConst::CURRENT_USER);
        if ($user == null) {
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("not login...."));
        }
        return ObjectToJSON::toJSON($this->iMessageService->add($user[MyConst::TABLE_USER_ID_FIELD], 
            $boardId, $content));
    }
    
    public function del($messageId) {
        $user = Session::get(MyConst::CURRENT_USER);
        if ($user == null) {
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("not login...."));
        }
        return ObjectToJSON::toJSON($this->iMessageService->del($user[MyConst::TABLE_USER_ID_FIELD],
            $messageId));
    }
    
    public function search($boardId) {
        $user = Session::get(MyConst::CURRENT_USER);
        if ($user == null) {
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("not login...."));
        }
        return ObjectToJSON::toJSON($this->iMessageService->search($boardId));
    }
    
    public function searchSelf() {
        $user = Session::get(MyConst::CURRENT_USER);
        if ($user == null) {
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("not login...."));
        }
        return $this->searchOnes($user[MyConst::TABLE_USER_ID_FIELD], $user[MyConst::TABLE_USER_BOARDID_FIELD]);
    }
    
    public function searchOnes($userId,$boardId) {
        $user = Session::get(MyConst::CURRENT_USER);
        if ($user == null) {
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("not login...."));
        }
        return ObjectToJSON::toJSON($this->iMessageService->searchOnes($userId, $boardId));
    }
    
    public function getAllBoard() {
        $user = Session::get(MyConst::CURRENT_USER);
        if ($user == null) {
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("not login...."));
        }
        return ObjectToJSON::toJSON($this->iMessageService->getAllBoard());
    }
}