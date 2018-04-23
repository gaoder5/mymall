<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 14:07
 */
namespace app\index\model;

use think\Model;

class Ad extends Model{
    public function getMediaTypeAttr($v){
        $data = [0 => '图片', 1 => 'flase',2=>'代码',3=>'文字'];
        return $data[$v];
    }
    public function getEnabledAttr($v){
        $data = [0 => '关闭', 1 => '开启'];
        return $data[$v];
    }
}