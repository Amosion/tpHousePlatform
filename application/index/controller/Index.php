<?php
namespace app\index\controller;

class Index extends Base
{
    //返回首页
    public function index()
    {
        //根据城市获取房屋信息
        $houseInfo = model('info')->getHouseByCity($this->city_id,$this->se_city_id);
        return $this->fetch('',[
            'houseInfo' => $houseInfo,
        ]);
    }
    //返回详情页
    public function detail(){
        $id = input('get.house_id');
        $houseInfo = model('info')->getHouseById($id);
        $evalInfo = model('evaluate')->getEvalInfo($id);

        return $this->fetch('',[
            'houseInfo' => $houseInfo,
            'evalInfo' => $evalInfo
        ]);
    }

}
