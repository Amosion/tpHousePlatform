<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/17
 * Time: 19:06
 */

namespace app\common\model;

use think\Model;

class Order extends BaseModel
{
    /**
     * 添加数据
     * @param array $data
     * @return mixed
     */
    public function add($data = []){
        if(!is_array($data)){
            exception('传递的数据不是数组');
        }
        $data['status'] = 0;
        $this->data($data)->allowField(true)->save();
        return $this->id;
    }

    /**
     * 获取租客对房屋的预约信息
     * @param $houseId
     * @param $userId
     * @return array|false|\PDOStatement|string|Model
     */
    public function getOrderInfo($houseId,$userId){
        $data = [
            'house_id' => $houseId,
            'renter_id' => $userId,
            'status' => 0
        ];
        return $this->where($data)->find();
    }

    /**
     * 根据用户id获取预约信息
     * @param $userId
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getOrderByUserId($userId){
        $data = [
            'renter_id' => $userId
        ];
        $order = [
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }
    /**
     * 根据状态获取预约信息
     * @param $status
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getOrderByStatus($status){
        $data = [
            'status' => ['egt',$status],
        ];
        return $this->where($data)->select();

    }
    /**
     * 根据houseId更新数据
     * @param $data
     * @param $houseId
     * @return false|int
     */
    public function updateByouseId($data, $houseId){
        return $this->allowField(true)->save($data, ['house_id'=>$houseId]);
    }
}