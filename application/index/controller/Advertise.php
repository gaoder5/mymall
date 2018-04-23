<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:34
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
class Advertise extends Controller{
    public function charts_1(){
        $model = model('ad');
        $re = $model->select();
        foreach ($re as $v){
            $a = Db::name('ad_position')->where(['position_id'=>$v['position_id']])->find();

            $v['position_id']=$a['position_id'];
        }
        return $this->fetch('charts_1',['re'=>$re]);
    }



    function delCheck(){
        $ids = implode(',',$_POST['checks']);//将数组转化成字符串
        if(isset($ids)){
            if(Db::name('ad')->delete($ids)){
                $this->success('删除成功','Advertise/charts_1');
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('删除数据不存在');
        }
    }

}