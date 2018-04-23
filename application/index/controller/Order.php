<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:31
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
class Order extends Controller{
//    订单列表
    public function product_list(){
        $model = model('OrderGoods');
        $re = $model->select();
        foreach ($re as $v){
            $a = Db::name('order_info')->where(['order_id'=>$v['order_id']])->find();
            $b = Db::name('goods')->where(['goods_id'=>$v['goods_id']])->find();
            $c = Db::name('cart')->where(['parent_id'=>$v['parent_id']])->find();
//            goods表
            $v['goods_id']=$b['goods_id'];
            $v['goods_name']=$b['goods_name'];
            $v['goods_sn']=$b['goods_sn'];
            $v['market_price']=$b['market_price'];
            $v['goods_price']=$b['shop_price'];
            $v['is_real']=$b['is_real'];
            $v['extension_code']=$b['extension_code'];
//            order_info表
            $v['order_id']=$a['order_sn'];
//            cart表
            $v['parent_id']=$c['parent_id'];
            $v['is_gift']=$c['is_gift'];
        }
        return $this->fetch('product_list',['re'=>$re]);
    }

//订单查询
    public function product_brand(){
        $model = model('OrderInfo');
        $re = $model->select();
        foreach ($re as $v){
            $a = Db::name('users')->where(['user_id'=>$v['user_id']])->find();
            $b = Db::name('goods_shipping')->where(['shipping_id'=>$v['shipping_id']])->find();
            $c= Db::name('payment')->where(['pay_id'=>$v['pay_id']])->find();
            $v['user_id']=$a['user_name'];
            $v['shipping_name']=$b['shipping_name'];
            $v['pay_name']=$c['pay_name'];
        }
        return $this->fetch('product_brand',['re'=>$re]);
    }
//    缺货登记
    public function booking_goods(){
        $model = model('BookingGoods');
        $re = $model->select();
        foreach ($re as $v){
            $a = Db::name('users')->where(['user_id'=>$v['user_id']])->find();
            $b = Db::name('goods')->where(['goods_id'=>$v['goods_id']])->find();
            $c = Db::name('admin_user')->where(['user_id'=>$v['user_id']])->find();
            $v['dispose_user']=$c['user_name'];
            $v['user_id']=$a['user_id'];
            $v['email']=$a['user_email'];
            $v['link_man']=$a['link_man'];
            $v['tel']=$a['tel'];
            $v['goods_id']=$b['goods_id'];
        }
        return $this->fetch('booking_goods',['re'=>$re]);
    }


    public function order_info(){
        return $this->fetch();
    }



//批量删除
    function delCheck(){
        $ids = implode(',',$_POST['checks']);//将数组转化成字符串
            if(isset($ids)){
            if(Db::name('order_goods')->delete($ids)){
                $this->success('删除成功','order/product_list');
            }else{
                $this->error('删除失败');
            }
            }else{
                $this->error('删除数据不存在');
        }
    }


//    修改
    public function product_save(){
        $request = request();
        $id = input('order_id');
        $model = model('order_info');
        if ($request->isGet()){
            $fid = \db('order_info')->find($id);
            $this->assign('fid',$fid);
            return $this->fetch();
        }
        if ($request->isPost()){
            $data = [
//                'order_id'=>input('order_id'),
                'province'=>input('province'),
                'city'=>input('city'),
                'district'=>input('district'),
                'address'=>input('address'),
                'mobile'=>input('mobile'),
//                'zipcode'=>input('zipcode')

            ];
//            var_dump($data);exit;
            $model->save($data);
//            if ($re){
//                $this->success('修改成功','product_brand');
//            }else{
//                $this->error('修改失败','product_save');
//            }
        }
    }
}