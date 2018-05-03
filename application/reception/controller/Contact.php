<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/25
 * Time: 11:30
 */

namespace app\reception\controller;


use think\Controller;

class Contact extends Controller
{
    public function contact(){
        return $this->fetch();
    }
}