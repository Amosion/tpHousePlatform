<?php
namespace app\renter\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $user = session('account','','user');
        if(!$user){
            $this->error('你未登录，请先登录',url('user/login/index'));
        }
        if($user->character_id != 3){
            $this->error('你不是租客',url('user/login/index'));
        }
        return $this->fetch('',[
            'user' => $user
        ]);
    }

    public function welcome(){
        return 'hello renter!';
    }
}
