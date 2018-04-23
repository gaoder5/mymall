<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/23
 * Time: 10:50
 */
namespace app\index\model;
use think\Model;

class GoodsCategory extends Model{
    function getShowInNavAttr($value){
        $data = [0=>'不显示',1=>'显示'];
        return $data[$value];
    }
    function getFilterAttrAttr($value){
        $data = [0=>'不显示',1=>'显示'];
        return $data[$value];
    }
}