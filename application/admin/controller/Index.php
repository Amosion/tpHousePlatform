<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $user = session('account','','user');
        if(!$user){
            $this->error('你未登录，请先登录',url('user/login/index'));
        }
        if($user->character_id != 1){
            $this->error('你不是管理员',url('user/login/index'));
        }
        return $this->fetch();
    }
    public function welcome(){
        return "Hello World!";
    }
    public function hello(){
        return "welcome";
    }
}
