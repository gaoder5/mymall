<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/19
 * Time: 14:41
 */
namespace app\index\controller;

//引入使用模型命名空间
use app\index\model\AdminUser as Log;
use think\Controller;

class AdminUser extends  Controller{
    public function login(){
        if(request()->isPost()){
            //实例化类
            $login = new log;
            //使用方法，接收input（），提交过来的值
            $status=$login->login(input('user_name'),input('password'));
            //判断用户是否登录
            if($status==1){
                return $this->success('登录成功',url('Index/index'));
            }elseif ($status==2){
                return $this->error('账户或密码错误');
            }else{
                return $this->error('用户不存在');
            }
        }
        return $this->fetch('login');
    }
}