<?php
namespace app\index\model;
use think\Model;
class Goods extends Model{
    public function getIsOnSaleAttr($v){
        $data=[0 => '否', 1 => '是'];
        return $data[$v];
    }
    public function getIsDeleteAttr($v){
        $data=[0 => '否', 1 => '是'];
        return $data[$v];
    }
}