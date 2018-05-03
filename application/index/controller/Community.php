<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:35
 */
namespace app\index\controller;
use think\Controller;

class Community extends Base {
    public function article_list(){
        return $this->fetch();
    }
}