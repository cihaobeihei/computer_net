<?php
namespace app\admin\controller;
use app\common\ObjectToJSON;
use app\admin\model\UserService;
class User{
    private $iUserService = null;
    public function __construct() {
        $this->iUserService = new UserService();
    }
    public function login($username, $password){
        // var_dump($this->iUserService);
        return ObjectToJSON::toJSON($this->iUserService->login($username, $password));
    }
}