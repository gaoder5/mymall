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
    //在线商品展示
    public function goods_list(){
        $model = new \app\index\model\Goods();
        $data = $model->where('is_delete',0)->select();
        $count = Db::name('goods')->where(['is_delete'=>0])->count();
        $this->assign('count',$count);
        foreach ($data as $v){
            $type = Db::name('goods_type')->where(['type_id'=>$v['goods_type']])->find();
            $v['goods_type']=$type['type_name'];
            $type = Db::name('goods_category')->where(['cat_id'=>$v['cat_id']])->find();
            $v['cat_id']=$type['cat_name'];
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    //删除商品展示
    public function goods_list_delete(){
        $model = new \app\index\model\Goods();
        $data = $model->where('is_delete',1)->select();
        foreach ($data as $v){
            $type = Db::name('goods_type')->where(['type_id'=>$v['goods_type']])->find();
            $v['goods_type']=$type['type_name'];
            $type = Db::name('goods_category')->where(['cat_id'=>$v['cat_id']])->find();
            $v['cat_id']=$type['cat_name'];
        }
        $this->assign('data',$data);
        $count = Db::name('goods')->where(['is_delete'=>1])->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    //添加商品
    public function goods_add(){
        $category = Db::name('goods_category')->select();
        $this->assign('category',$category);
        $type = Db::name('goods_type')->where('enabled',1)->select();
        $this->assign('type',$type);
        $brand = Db::name('goods_brand')->select();
        $this->assign('brand',$brand);
        return $this->fetch();
    }
    //二级联动ajax请求
    function getCategory(){
        Request::instance()->param();
        if(\request()->isPost()){
            $tid=input('type');
            $a['type_id']=$tid;
            $cat=Db::name('goods_category')->where($a)->select();
            return json($cat);
        }
    }
    //商品上下架
    function goods_shelf(){
        if (\request()->isGet()){
            $id = input('goods_id');
            $data = Db::name('goods')->where(['goods_id'=>$id])->find();
            if ($data['is_on_sale'] == 0){
                Db::name('goods')->where(['goods_id'=>$id])->update(['is_on_sale'=>1]);
                $this->success('已上架','goods_list');
            }elseif ($data['is_on_sale'] == 1)
                Db::name('goods')->where(['goods_id'=>$id])->update(['is_on_sale'=>0]);
                $this->success('已下架','goods_list');
        }
    }
    //商品状态（在线/删除）
    function goods_delete(){
        if (\request()->isGet()){
            $id = input('goods_id');
            $data = Db::name('goods')->where(['goods_id'=>$id])->find();
            if ($data['is_delete'] == 1){
                Db::name('goods')->where(['goods_id'=>$id])->update(['is_delete'=>0]);
                $this->success('添加成功','goods_list');
            }elseif ($data['is_delete'] == 0){
                Db::name('goods')->where(['goods_id'=>$id])->update(['is_delete'=>1,'is_on_sale'=>0]);
                $this->success('删除成功','goods_list');
            }
        }
    }
    //编辑
    function goods_update(){
        $model = new \app\index\model\Goods();
        if (\request()->isGet()){
            $id = input('goods_id');
            $data = $model->where(['goods_id'=>$id])->find();
            $this->assign('data',$data);
            $category = Db::name('goods_category')->select();
            $this->assign('category',$category);
            $type = Db::name('goods_type')->select();
            $this->assign('type',$type);
            $brand = Db::name('goods_brand')->select();
            $this->assign('brand',$brand);
            return $this->fetch();
        }elseif (\request()->isPost()){
            $data = input();
            $data['goods_brief'] = substr($data['goods_desc'],'0','30').'......';
            $file=\request()->file('original_img');
            if($file){
                $info=$file->move(ROOT_PATH.'public/uploads');
                if($info){
                    $data['original_img']=$info->getSaveName();
                }
            }
            $data['give_integral'] = floor($data['shop_price']/100);
            if (Db::name('goods')->where(['goods_id'=>$data['goods_id']])->data($data)->update()){
                $this->success('编辑成功','goods_list');
            }else{
                $this->error('编辑失败','goods_list');
            }
        }

    }




    function goods_addSave(){
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
            $this->success('添加成功',url('goods_list'));
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