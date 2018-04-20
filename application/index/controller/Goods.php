<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:29
 */
namespace app\index\controller;
use think\Controller;

class Goods extends Controller{
    public function picture_list(){
        return $this->fetch();
    }
    public function picture_add(){
        return $this->fetch();
    }
    public function picture_show(){
        return $this->fetch();
    }
    public function product_brand(){
        return $this->fetch();
    }
    public function product_list(){
        return $this->fetch();
    }
    public function product_add(){
        return $this->fetch();
    }




}