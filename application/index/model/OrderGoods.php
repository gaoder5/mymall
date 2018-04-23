<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 10:28
 */
namespace app\index\model;

use think\Model;

class OrderGoods extends Model{
    public function getSendNumberAttr($v){
        $data = [0 => '否', 1 => '是'];
        return $data[$v];
    }
    public function getIsRealAttr($v){
        $data = [0 => '否', 1 => '是'];
        return $data[$v];
    }
    public function getIsGiftAttr($v){
        $data = [0 => '否', 1 => '是'];
        return $data[$v];
    }
}