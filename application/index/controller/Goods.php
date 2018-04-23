<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:29
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class Goods extends Controller{
    public function goods_list(){
        $model = new \app\index\model\Goods();
        $data = $model->select();
        foreach ($data as $v){
            $type = Db::name('goods_type')->where(['type_id'=>$v['goods_type']])->find();
            $v['goods_type']=$type['type_name'];
            $type = Db::name('goods_category')->where(['cat_id'=>$v['cat_id']])->find();
            $v['cat_id']=$type['cat_name'];
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function goods_add(){
        $category = Db::name('goods_category')->select();
        $this->assign('category',$category);
        $type = Db::name('goods_type')->select();
        $this->assign('type',$type);
        $brand = Db::name('goods_brand')->select();
        $this->assign('brand',$brand);
        return $this->fetch();
    }
    function getCategory(){
        Request::instance()->param();
        if(\request()->isPost()){
            $tid=input('type');
            $a['cat_id']=$tid;
            $cat=Db::name('goods_category')->where($a)->select();
            return json($cat);
        }
    }
    function picture_addSave(){
        $data = \request()->post();
        $data['goods_brief'] = substr($data['goods_desc'],'0','30').'......';
        $file=\request()->file('original_img');
        if($file){
            $info=$file->move(ROOT_PATH.'public/uploads');
            if($info){
                $data['original_img']=$info->getSaveName();
            }
        }
        $data['give_integral'] = floor($data['shop_price']/100);
        if (Db::name('goods')->insert($data)){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }



    public function picture_show(){
        return $this->fetch();
    }
    public function product_brand(){
        return $this->fetch();
    }
    public function product_list(){
        return $this->fetch();
    }
    public function product_add(){
        return $this->fetch();
    }




}