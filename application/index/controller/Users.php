<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:27
 */
namespace app\index\controller;
use think\Controller;

class Users extends Controller{
    public function member_list(){
        return $this->fetch();
    }
    public function member_add(){
        return $this->fetch();
    }
    public function change_password(){
        return $this->fetch();
    }
    public function member_level(){
        return $this->fetch();
    }
    public function member_scoreoperation(){
        return $this->fetch();
    }
}