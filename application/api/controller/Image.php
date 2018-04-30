<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\File;

class Image extends Controller
{
    //头像图片
    public function upload()
    {
        $file = Request::instance()->file('file');
        $info = $file->move('upload/image');
        if ($info && $info->getPathname()) {
            return show(1, 'success', '/'.$info->getPathname());
        }
        return show(0, 'error');
    }
    //房屋相关图片
    public function houseUpload()
    {
        $file = Request::instance()->file('file');
        $info = $file->move('upload/house');
        if ($info && $info->getPathname()) {
            return show(1, 'success', '/'.$info->getPathname());
        }
        return show(0, 'error');
    }

}