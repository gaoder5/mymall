<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/25
 * Time: 11:31
 */

namespace app\reception\controller;


use think\Controller;

class Account extends Controller
{
    public function account(){
        return $this->fetch();
    }
}