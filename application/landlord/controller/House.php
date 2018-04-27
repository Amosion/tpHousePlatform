<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/26
 * Time: 21:40
 */

namespace app\landlord\controller;

use think\Controller;

class House extends Controller
{
    public function add(){
        $citysInfo = model('City')->getCitysInfo();
        return $this->fetch('',[
            'citysInfo' => $citysInfo
        ]);
    }

}