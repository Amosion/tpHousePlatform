<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/18
 * Time: 0:06
 */

namespace app\renter\controller;

use think\Controller;

class Order extends Controller
{
    //预约管理
    public function index(){
        $account = session('account','','user');
        $orderInfo = model('Order')->getOrderByUserId($account->id);

        return $this->fetch('',[
            'orderInfo' => $orderInfo
        ]);
    }
    //房屋详情页
    public function detail(){
        $house_id = input('get.id');
        if(!$house_id){
            $this->error('id不合法');
        }
        $houseInfo = model('info')->getHouseById($house_id);

        return $this->fetch('',[
            'houseInfo' => $houseInfo
        ]);
    }
    //修改状态
    public function status(){
        $data = input('get.');
        if(!$data){
            $this->error('参数不合法');
        }
        $id = model('Order')->updateById(['status' => $data['status']],$data['id']);

        if(!$id){
            $this->error('更新失败');
        }else{
            $this->success('更新成功');
        }
    }
    //房东电话
    public function landTel(){
        $id = input('get.house_id');
        if(!$id){
            $this->error('id不合法');
        }
        $house = model('Info')->getHouseById($id);
        $ownId = $house->owner_id;
        if(!$ownId){
            $this->error('id又不合法');
        }
        $user = model('Userinfo')->getUserInfo($ownId);
        return $this->fetch('',[
            'user' => $user
        ]);
    }

}