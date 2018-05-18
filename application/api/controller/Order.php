<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/17
 * Time: 20:01
 */

namespace app\api\controller;

use think\Controller;

class Order extends Controller
{
    public function add(){

        $id = input('post.id');
        if (!$id){
            $this->error('id不合法');
        }
        $user = session('account','','user');
        if(!$user){
            $this->error('你未登录，请先登录',url('user/login/index'));
        }
        $orderData = [
            'house_id' => $id,
            'renter_id' => $user->id
        ];
        $orderId = model('Order')->add($orderData);
        if (!$orderId){
            return show(0,'error');
        }
        return show(1,'success');

    }

}