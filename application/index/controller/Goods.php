<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:29
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class Goods extends Controller{

    //展示列表
    public function goods_list(){
        $list=Db::name('goods')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function goods_add(){
        return $this->fetch();
    }
    public function picture_show(){
        return $this->fetch();
    }
    public function product_list(){
        return $this->fetch();
    }
    public function product_add(){
        return $this->fetch();
    }



}