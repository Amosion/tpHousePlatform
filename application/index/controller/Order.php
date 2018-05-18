<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/17
 * Time: 17:19
 */

namespace app\index\controller;


class Order extends Base
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Order');
    }

    /**
     * 预约添加 / 已换为api
     */
    public function add(){
        if (!$this->request->post()){
            $this->error('非post方式提交');
        }
        $user = session('account','','user');
        if(!$user){
            $this->error('你未登录，请先登录',url('user/login/index'));
        }
        $data = input('post.');
        $orderData = [
            'house_id' => $data['house_id'],
            'renter_id' => $user->id
        ];
        $id = $this->obj->add($orderData);
        if ($id){
            $this->success('发送成功');
        }else{
            $this->error('发送失败');
        }
    }
}