<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/3/22
 * Time: 19:51
 */

namespace app\admin\controller;

use think\Controller;

class City extends Controller
{
    private $obj;
    public function _initialize(){
        $this->obj = model("City");
    }
    //城市一览
    public function index(){
        if(!request()->isGET()){
            return "非GET方法提交";
        }
        $parentId = input('get.parent_id', 0,'intval');
        //保存parent_id => 省城名
        $mCitysArr = [];
        //获取省份数据
        $citysInfo = $this->obj->getCitysInfo($parentId);
        //获取省城数据
        $mainCitys = $this->obj->getMainCitys();
        foreach ($mainCitys as $city){
                $mCitysArr[$city['parent_id']] = $city['name'];
        };
        return $this->fetch('',[
            'citysInfo' => $citysInfo,
            'mCitysArr' => $mCitysArr
        ]);
    }
    //城市添加
    public function add(){
        $citysInfo = $this->obj->getCitysInfo();
        return $this->fetch('',[
            'citysInfo' => $citysInfo
        ]);
    }
    //城市细节信息
    public function detail($id = 0){
        if (intval($id) < 0){
            $this->error('id参数不合法');
        }
        $citysInfo = $this->obj->getCitysInfo();
        $cityInfo = $this->obj->get($id);
        return $this->fetch('',[
            'citysInfo' => $citysInfo,
            'cityInfo' => $cityInfo
        ]);
    }
    //城市添加提交
    public function save(){
        //校验
        if(!request()->isPost()){
            $this->error('非post方式提交');
        }
        $data = input('post.');
        //tp5验证
        $validate = validate('City');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //更新信息
        if(!empty($data['id'])){
            $this->update($data);
        }else{
            //添加信息
            $res = $this->obj->add($data);
            if($res){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }
    }
    //修改城市信息
    public function update($data = 0){
        $res = $this->obj->save($data,['id' => intval($data['id'])]);
        if($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

    //删除城市信息
    public function delete(){
        if(!request()->isGET()){
            return "非GET方法提交";
        }
        $id = input('get.id');
        $res = $this->obj->cityDelete($id);
        if($res){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }

    }

}