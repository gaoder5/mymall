<?php

/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/5/2
 * Time: 11:55
 */
namespace app\person\controller;
use think\Controller;
use think\Db;

class Home extends Controller
{
    public function home(){

        return $this->fetch('login');
    }

    public function register(){
        return $this->fetch('register');
    }

    public function one(){
        $brand=Db::name('goods_brand')->select();
        $this->assign('brand',$brand);

        $oneCat=Db::name('goods_category')->where('p_id',0)->select();
        $this->assign('oneCat',$oneCat);
//        var_dump($oneCat);exit;
        $twoCat=Db::name('goods_category')->where('p_id>0')->select();
        $this->assign('twoCat',$twoCat);
//        var_dump($twoCat);exit;
        return $this->fetch('home2');
    }
}