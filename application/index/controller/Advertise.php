<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:34
 */
namespace app\index\controller;
use think\Controller;

class Advertise extends Controller{
    public function charts_1(){
        return $this->fetch();
    }
}