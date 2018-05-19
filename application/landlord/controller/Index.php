<?php
namespace app\landlord\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $user = session('account','','user');
        if(!$user){
            $this->error('你未登录，请先登录',url('user/login/index'));
        }
        if($user->character_id != 2){
            $this->error('你不是房东',url('user/login/index'));
        }
        return $this->fetch('',[
            'user' => $user
        ]);
    }

    public function welcome(){
        return 'landlord';
    }

}
