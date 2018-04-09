<?php
namespace app\renter\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome(){
        return 'hello renter!';
    }
}
