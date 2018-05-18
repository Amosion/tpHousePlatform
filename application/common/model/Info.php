<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/30
 * Time: 0:14
 */

namespace app\common\model;

use think\Model;

class Info extends Model
{
    /**
     * 房屋信息添加
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
     * 根据landlordid获取房屋信息
     * @param int $userId
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getLandHouse($userId = 0){
        $data = [
            'owner_id' => $userId
        ];
        $order = [
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

    /**
     * 根据id获取房源信息
     * @param int $id
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getHouseById($id = 0){
        $data = [
            'id' => $id,
            'status' => 1
        ];
        return $this->where($data)->find();
    }

    /**
     * 根据城市获取房屋信息
     * @param $city
     * @param $seCity
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getHouseByCity($city,$seCity){
        $data = [
            'status' => 1,
            'city' => $city.','.$seCity,
        ];
        $order = [
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

}