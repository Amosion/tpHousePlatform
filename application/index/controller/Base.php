<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/8
 * Time: 22:34
 */

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    public $city = '广东';
    public $city_id = 1;
    public $se_citys = '';
    public function _initialize()
    {
        $citys = model('city')->getCitysInfo();
        if(request()->get()){
            $this->city = input('get.city');
            $this->city_id = input('get.id');
        }
        $this->se_citys = model('city')->getCitysInfo($this->city_id);
        $this->assign('citys',$citys);
        $this->assign('city',$this->city);
        $this->assign('city_id',$this->city_id);
        $this->assign('se_citys',$this->se_citys);
    }


}