<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/23
 * Time: 15:35
 */
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Db;
class Base extends Controller{
    protected $beforeActionList = [
        'first'
    ];
    public function first(){
     $admin = Session::get('user_name');
        if(!$admin){
            $this->redirect('AdminUser/login');
        }
    }
}