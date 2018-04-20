<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:37
 */
namespace app\index\controller;
use think\Controller;

class System extends Controller{
    function link_list(){
        return $this->fetch();
    }
    function system_method(){
        return $this->fetch();
    }
    function system_area(){
        return $this->fetch();
    }
    function link_add(){
        return $this->fetch();
    }
}