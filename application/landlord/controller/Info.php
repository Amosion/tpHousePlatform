<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/4/30
 * Time: 0:14
 */

namespace app\landlord\controller;

use think\Controller;
use think\Request;

class Info extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj = model('Info');
    }

    /**
     * 房屋列表页面
     * @return mixed
     */
    public function index(){
        return $this->fetch();
    }
    /**
     * 房屋添加页面
     * @return mixed
     */
    public function add(){
        $citysInfo = model('City')->getCitysInfo();
        return $this->fetch('',[
            'citysInfo' => $citysInfo
        ]);
    }

    public function save(){
        if(!$this->request->post()){
            $this->error('非post方式提交');
        }
        $data = input('post.');
        //tp5验证
        $validate = validate('House');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //房东信息
        $user = session('account','','user');
        //房屋信息入库
        $houseData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'area' => $data['area'],
            'type' => $data['type_shi'].','.$data['type_ting'].','.$data['type_wei'],
            'rent_type' => $data['rent_type'],
            'orient' => $data['orient'],
            'city' => $data['city'].','.$data['se_city'],
            'address' => $data['address'],
            'certify' => $data['certify'],
            'image' => $data['image'],
            'owner_id' => $user->id
        ];
        $info = $this->obj->add($houseData);
        if($info){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }

}