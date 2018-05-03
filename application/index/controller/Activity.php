<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:32
 */
namespace app\index\controller;
use think\Controller;

class Activity extends Base {
    public function Card_list(){
        return $this->fetch();
    }

    public function Group(){
        return $this->fetch();
    }

    public function credits_list(){
        return $this->fetch();
    }

    public function special_list(){
        return $this->fetch();
    }
}