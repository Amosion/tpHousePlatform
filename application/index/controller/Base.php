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
    public $se_city = '肇庆';
    public $se_city_id = 34;
    public $account = '';

    public function _initialize()
    {
        //获取所有一级城市
        $citys = model('city')->getCitysInfo();
        //获取点击的一级城市信息
        if(input('get.city')){
            $this->city = input('get.city');
            $this->city_id = input('get.id');
        }
        //根据一级城市获取二级城市
        $this->se_citys = model('city')->getCitysInfo($this->city_id);
        //设置二级城市
        if(input('get.se_city_id')) {
            $this->se_city = input('get.se_city');
            $this->se_city_id = input('get.se_city_id');
        }
        //模板变量设置
        $this->assign('citys',$citys);
        $this->assign('city',$this->city);
        $this->assign('se_city',$this->se_city);
        $this->assign('se_citys',$this->se_citys);
        $this->assign('user',$this->getLoginUser());
    }
    /**
     * 获取登陆用户
     * @return mixed|string
     */
    public function getLoginUser(){
        if(!$this->account){
            $this->account = session('account','','user');
        }
        return $this->account;
    }

}