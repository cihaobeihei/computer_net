<?php

namespace app\admin\controller;
use think\Db;
class Index{
    public function index(){
        // dump(config("database"));
        // $res = Db::connect();
        $res = Db::query('select * from user where id=?',[1]);
        dump($res);
    } 
}