<?php
namespace app\admin\model;
use think\Db;
use app\common\ServerResponse;
use think\Session;
use app\common\MyConst;
class UserService {
    public function login($username, $password)
    {
        $user = Db::table(MyConst::TABLE_USER)->where(MyConst::TABLE_USER_USERNAME_FIELD, $username)
        ->where(MyConst::TABLE_USER_PWD_FIELD, $password)
        ->find();
        if ($user == null) {
            return ServerResponse::createByErrorMessage("username or passwd error!");
        }
        if ($user[MyConst::TABLE_USER_ROLE_FIELD] != MyConst::ROLE_ADMIN){
            return ServerResponse::createByErrorMessage("user not admin");
        }
        Session::set(MyConst::CURRENT_USER, $user);
        return ServerResponse::createBySuccessMessage($user);
    }
}