<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/19
 * Time: 10:05
 */
namespace app\reception\controller;
use think\Controller;
use think\Db;

class Index extends Controller{
    public function index(){
        $goods=Db::name('goods')->select();
        $this->assign('goods',$goods);
        $brand=Db::name('goods_brand')->select('brand_name');
        $this->assign('brand',$brand);
        return $this->fetch();
    }
}