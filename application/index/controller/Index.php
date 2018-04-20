<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:42
 */
namespace app\index\controller;
use think\Controller;

class Index extends Controller{
    public function index()
    {
        return $this->fetch();
    }
    public function welcome()
    {
        return $this->fetch();
    }

}