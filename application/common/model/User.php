<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/5
 * Time: 22:55
 */

namespace app\common\model;

use think\Model;

class User extends Model
{
    /**
     * 用户添加数据
     * @param array $data
     * @return mixed
     */
    public function add($data = []){
        if(!is_array($data)){
            exception('传递的数据不是数组');
        }
        $data['status'] = 1;
        $this->data($data)->allowField(true)->save();
        return $this->id;
    }

    /**
     * 根据id更新数据
     * @param $data
     * @param $id
     * @return false|int
     */
    public function updateById($data, $id){
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
    /**
     * 据id获取账号信息
     * @param $id
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getUserById($id){
        $data = [
            'id' => $id
        ];
        return $this->where($data)->find();
    }

}