<?php
namespace app\renter\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $user = session('account','','user');
        return $this->fetch('',[
            'user' => $user
        ]);
    }

    public function welcome(){
        return 'hello renter!';
    }
}
