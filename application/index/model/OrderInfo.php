<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/23
 * Time: 9:01
 */
namespace app\index\model;

use think\Model;

class OrderInfo extends Model{
    public function getOrderStatusAttr($v){
        $data = [0 => '未确认', 1 => '确认',2=>'已取消',3=>'无效',4=>'退货'];
        return $data[$v];
    }

    public function getShippingStatusAttr($v){
        $data = [0 => '未发货', 1 => '已发货',2=>'已收货',3=>'退货'];
        return $data[$v];
    }

    public function getPayStatusAttr($v){
        $data = [0 => '未付款', 1 => '付款中',2=>'已付款'];
        return $data[$v];
    }
}