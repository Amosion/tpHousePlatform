<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/18
 * Time: 15:22
 */

namespace app\landlord\controller;

use think\Controller;

class Order extends Controller
{
    //接受预约界面
    public function index(){
        $account = session('account','','user');
        //房东的所有房源
        $houseInfos = model('Info')->getLandHouse($account->id);
        //所有status = 0的预约
        $orderInfos = model('Order')->getOrderByStatus(0);
        //所有房源的 houseid => renterid数组
        $houseArr = [];
        $statusArr = [];
        foreach ($orderInfos as $orderInfo){
            foreach ($houseInfos as $houseInfo){
                if($houseInfo->id == $orderInfo->house_id){
                    $houseArr[$houseInfo->id] = $orderInfo->renter_id;
                    $statusArr[$houseInfo->id] = $orderInfo->status;
                }
            }
        }
        //houseid数组
        $keys = array_reverse(array_keys($houseArr));
        return $this->fetch('',[
            'keys' => $keys,
            'houseArr' => $houseArr,
            'statusArr' => $statusArr
        ]);
    }
    //修改状态
    public function status(){
        $data = input('get.');
        if(!$data){
            $this->error('参数不合法');
        }
        $id = model('Order')->updateByouseId(['status' => $data['status']],$data['house_id']);

        if(!$id){
            $this->error('更新失败');
        }else{
            $this->success('更新成功');
        }
    }

}