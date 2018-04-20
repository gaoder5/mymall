<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:36
 */
namespace app\index\controller;
use think\Controller;

class Report extends Controller{
    function user(){
        return $this->fetch();
    }
    function order(){
        return $this->fetch();
    }
    function water(){
        return $this->fetch();
    }
    function lack(){
        return $this->fetch();
    }
    function lowstore(){
        return $this->fetch();
    }
}