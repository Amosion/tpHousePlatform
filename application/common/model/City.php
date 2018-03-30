<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/3/23
 * Time: 21:14
 */

namespace app\common\model;

use think\Model;

class City extends Model
{
    /**
     * 添加城市信息
     * @param $data
     * @return false|int
     */
    public function add($data){
      return $this->save($data);
    }

    /**
     * 获取城市信息
     * @param int $parent_id
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getCitysInfo($parent_id = 0){
        $data = [
            'parent_id' => $parent_id,
        ];
        $order = [
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

    /**
     * 获取省城信息
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getMainCitys(){
        $data = [
            'is_main' => 1
        ];
        $order = [
            'id' => 'desc'
        ];
        return $this->where($data)->order($order)->select();
    }

    /**
     * 删除城市信息
     * @param $id
     * @return int
     */
    public function cityDelete($id = 0){
        $data = [
            'id' => $id
        ];
        return $this->where($data)->delete();
    }

}