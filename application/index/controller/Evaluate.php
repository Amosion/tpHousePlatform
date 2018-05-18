<?php
/**
 * Created by PhpStorm.
 * User: Amadeus
 * Date: 2018/5/17
 * Time: 1:05
 */

namespace app\index\controller;


class Evaluate extends Base
{
    /**
     * 添加评论信息
     */
    public function add(){
        if(!request()->post()){
            $this->error('非post方式提交');
        }
        //获取帐号信息
        $account = $this->getLoginUser();
        if(!$account){
            $this->error('请登录评论',url('user/login/index'));
        }
        $data = input('post.');
        $commentData = [
            'description' => $data['comment'],
            'user_id' => $account->id,
            'house_id' => $data['house_id'],
            'evaluate' => 0
        ];
        $id = model('Evaluate')->add($commentData);
        if($id){
            $this->success('发表成功');
        }else{
            $this->error('发表失败');
        }
    }

}