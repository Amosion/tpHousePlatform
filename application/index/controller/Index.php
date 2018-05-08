<?php
namespace app\index\controller;

class Index extends Base
{
    public function index()
    {
        $houseInfo = model('info')->getHouseByStatus(1);
        return $this->fetch('',[
            'houseInfo' => $houseInfo,
        ]);
    }
}
