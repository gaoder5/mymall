<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/23
 * Time: 10:23
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class GoodsCategory extends Controller {
    public function product_list(){
        $model = new \app\index\model\GoodsCategory();
        $list = $model->select();
        foreach ($list as $v){
            $date = Db::name('goods_type')->where(['type_id'=>$v['type_id']])->find();
            $data = Db::name('goods_units')->where(['units_id'=>$v['units_id']])->find();
            $v['type_id']=$date['type_name'];
            $v['units_id']=$data['units_name'];
        }
        $this->assign('list',$list);
        return $this->fetch();
    }
    //添加
    public function product_add(){
        $model = new \app\index\model\GoodsCategory;
        if (request()->isGet()){
            $date = Db::name('goods_type')->select();
            $re = Db::name('goods_units')->select();
            $this->assign('re',$re);
            $this->assign('data',$date);
            return $this->fetch();
        }else{
            $data = request()->post();
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('product_list'));
            }else{
                $this->error('添加失败');
            }
        }

    }
    //模糊查询
    public function search(){
        $content = $_POST['aa'];
        $sql = "select * from `s_goods_category` where `cat_name` like '%".$content."%'";
        $brand = Db::table('goods_category')->query($sql);
        return $this->fetch('product_list',['list' =>$brand]);
    }

    //修改
    public function product_edit(){
        if(request()->isGet()){
            $list = Db::name('goods_type')->select();
            $re = Db::name('goods_units')->select();
            $this->assign('re',$re);
            $this->assign('list',$list);
            $model=new \app\index\model\GoodsCategory();
            $data=$model->find(input('cat_id'));
            $this->assign('data',$data);
            return $this->fetch();
        }elseif(request()->isPost()){
            $model=new \app\index\model\GoodsCategory();
            $data=request()->post();
            $re = $model->update($data);
            if($re){
                $this->success('修改成功',url('product_list'));
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除
    public function product_delete(){
        $re=Db::name('goods_category')->delete(input('cat_id'));
        if($re){
            $this->success('删除成功','product_list');
        }else{
            $this->error('删除失败');
        }
    }
    //批量删除
    function delCheck(){
        $ids = implode(',',$_POST['checks']);//将数组转化成字符串
        if(isset($ids)){
            if(Db::name('goods_category')->delete($ids)){
                $this->success('删除成功','product_list');
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('删除数据不存在');
        }
    }
}