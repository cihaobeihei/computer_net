<?php
namespace app\index\model;

use think\Db;
use app\common\MyConst;
use app\common\ServerResponse;
class MessageService{
    
    public function add($userId, $boardId, $content) {
        $board = Db::table(MyConst::TABLE_BOARD)->where(MyConst::TABLE_BOARD_ID_FIELD,$boardId)->find();
        if($board == null){
            return ServerResponse::createByErrorMessage("board is not exsit");
        }
//         $data = [
//             MyConst::TABLE_MESSAGE_USERID_FIELD=>$userId,
//             MyConst::TABLE_MESSAGE_BOARDID_FIELD=>$boardId,
//             MyConst::TABLE_MESSAGE_CONTENT_FIELD=>$content,
//             MyConst::TABLE_MESSAGE_CREATETIME_FIELD=>"now()"
//         ];
//         $res = Db::table(MyConst::TABLE_MESSAGE)->insert($data);
        $sql = "INSERT INTO `message`(`board_id`,`user_id`,`content`,`create_time`) values(${boardId},${userId},'${content}',now())";
//         echo $sql;$res = 0;
        $res = Db::execute($sql);

        if($res > 0){
            return ServerResponse::createBySuccessMessage("success");
        }
        return ServerResponse::createByErrorMessage("data insert error!!!");
    }
    
    public  function del($userId, $messageId) {
        $message = Db::table(MyConst::TABLE_MESSAGE)->where(MyConst::TABLE_MESSAGE_ID_FIELD,$messageId)->find();
        if($message == null){
            return ServerResponse::createByErrorMessage("message not exsist");
        }
        if($userId != $message[MyConst::TABLE_MESSAGE_USERID_FIELD]){
            return ServerResponse::createByErrorMessage("This not your message!!!");
        }
        $res = Db::table(MyConst::TABLE_MESSAGE)->delete($messageId);
        if($res > 0){
            return ServerResponse::createBySuccessMessage("success");
        }
        return ServerResponse::createByErrorMessage("delete message error");
    }
    
    public function search($boardId) {
        $board = Db::table(MyConst::TABLE_BOARD)->where(MyConst::TABLE_BOARD_ID_FIELD,$boardId)->find();
        if($board == null){
            return ServerResponse::createByErrorMessage("board is not exsit");
        }
        $messages = Db::table(MyConst::TABLE_MESSAGE)->where(MyConst::TABLE_MESSAGE_BOARDID_FIELD,$boardId)->select();
        return ServerResponse::createBySuccessMessage($messages);
    }
    
    public function searchOnes($userId,$boardId) {
        $board = Db::table(MyConst::TABLE_BOARD)->where(MyConst::TABLE_BOARD_ID_FIELD,$boardId)->find();
        if($board == null){
            return ServerResponse::createByErrorMessage("board is not exsit");
        }
        $messages = Db::table(MyConst::TABLE_MESSAGE)->where(MyConst::TABLE_MESSAGE_USERID_FIELD,$userId)
        ->where(MyConst::TABLE_MESSAGE_BOARDID_FIELD,$boardId)->select();
        return ServerResponse::createBySuccessMessage($messages);
    }
    
    public function getAllBoard() {
        $boards = Db::table(MyConst::TABLE_BOARD)->select();
        return ServerResponse::createBySuccessMessage($boards);
    }
}