<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/19
 * Time: 10:05
 */
namespace app\reception\controller;
use think\Controller;

class Index extends Controller{
    public function index(){
        return $this->fetch();
    }
    public function account(){
        return $this->fetch();
    }
    public function contact(){
        return $this->fetch();
    }
    public function product(){
        return $this->fetch();
    }
    public function register(){
        return $this->fetch();
    }
    public function single(){
        return $this->fetch();
    }
}