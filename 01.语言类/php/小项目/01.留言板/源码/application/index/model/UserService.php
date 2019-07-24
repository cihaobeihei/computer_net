<?php
namespace app\index\model;

use think\Db;
use app\common\ServerResponse;
use think\Session;
use app\common\MyConst;

class UserService
{

    public function login($username, $password)
    {
        $user = Db::table(MyConst::TABLE_USER)->where(MyConst::TABLE_USER_USERNAME_FIELD, $username)
            ->where(MyConst::TABLE_USER_PWD_FIELD, $password)
            ->find();
        if ($user == null) {
            return ServerResponse::createByErrorMessage("username or passwd error!");
        }
        if ($user[MyConst::TABLE_USER_ROLE_FIELD] != MyConst::ROLE_CUSTOMER){
            return ServerResponse::createByErrorMessage("This is admin user");
        }
        Session::set(MyConst::CURRENT_USER, $user);
        return ServerResponse::createBySuccessMessage($user);
    }

    public function logout()
    {
        $user = Session::get(MyConst::CURRENT_USER);
        if ($user == null) {
            return ServerResponse::createByErrorMessage("not login!!!");
        }
        Session::delete(MyConst::CURRENT_USER);
        return ServerResponse::createBySuccessMessage("logout success!");
    }

    public function register($username, $password)
    {
        $user = Db::table(MyConst::TABLE_USER)->where(MyConst::TABLE_USER_USERNAME_FIELD, $username)->find();
        if ($user != null) {
            return ServerResponse::createByErrorMessage("same username exist try another one!!!");
        }
        // insert data to user and board
        $board = [
            MyConst::TABLE_BOARD_USERID_FIELD => '0'
        ];
        $res = Db::table(MyConst::TABLE_BOARD)->insert($board);
        if($res == 0){
            return ServerResponse::createByErrorMessage("insert faild!!!");
        }
        $boardId = Db::name(MyConst::TABLE_BOARD)->getLastInsID();

        $user = [
            MyConst::TABLE_USER_USERNAME_FIELD => $username,
            MyConst::TABLE_USER_PWD_FIELD => $password,
            MyConst::TABLE_USER_BOARDID_FIELD => $boardId,
            MyConst::TABLE_USER_ROLE_FIELD => MyConst::ROLE_CUSTOMER
        ];
        $res = Db::table(MyConst::TABLE_USER)->insert($user);
        if($res == 0){
            return ServerResponse::createByErrorMessage("insert faild!!!");
        }
        $userId = Db::name(MyConst::TABLE_USER_ID_FIELD)->getLastInsID();
        $res = Db::table(MyConst::TABLE_BOARD)->where(MyConst::TABLE_BOARD_ID_FIELD, $boardId)->update([
            MyConst::TABLE_BOARD_USERID_FIELD => $userId
        ]);
        if($res == 0){
            return ServerResponse::createByErrorMessage("insert faild!!!");
        }
        return ServerResponse::createBySuccessMessage("insert ok !!!");
    }
}