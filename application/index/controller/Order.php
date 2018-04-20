<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:31
 */
namespace app\index\controller;
use think\Controller;

class Order extends Controller{
    public function product_brand(){
        return $this->fetch();
    }
    public function product_add(){
        return $this->fetch();
    }
}