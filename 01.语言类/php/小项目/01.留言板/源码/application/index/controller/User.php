<?php
namespace app\index\controller;
use think\Request;
use app\index\model\UserService;
use app\common\ObjectToJSON;
use think\Session;
use app\common\MyConst;
use app\common\ServerResponse;
class User{
    private $iUserService = null;
    public function __construct() {
        $this->iUserService = new UserService();
    }
    public function login($username, $password){
        // var_dump($this->iUserService);
        return ObjectToJSON::toJSON($this->iUserService->login($username, $password));
    }
    
    public function logout(){
        $user = session(MyConst::CURRENT_USER);
        if($user == null){
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("please login first!!!"));
        }
        return ObjectToJSON::toJSON($this->iUserService->logout());
    }
    
    public function getUserInfo() {
        $user = session(MyConst::CURRENT_USER);
        if($user == null){
            return ObjectToJSON::toJSON(ServerResponse::createByErrorMessage("please login first!!!"));
        }
        return ObjectToJSON::toJSON(ServerResponse::createBySuccessMessage($user));
    }
    
    public function register($username, $password) {
        return ObjectToJSON::toJSON($this->iUserService->register($username, $password));
    }
}