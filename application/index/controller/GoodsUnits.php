<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/25
 * Time: 14:07
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class GoodsUnits extends Controller{
    public function units_list(){
        $model = new \app\index\model\GoodsUnits();
        $list = $model->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function units_add(){
        $model = new \app\index\model\GoodsUnits();
        if (request()->isGet()){
            return $this->fetch();
        }else{
            $data = request()->post();
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('units_list'));
            }else{
                $this->error('添加失败');
            }
        }

    }
    //模糊查询
    public function search(){
        $content = $_POST['aa'];
        $sql = "select * from `s_goods_units` where `units_name` like '%".$content."%'";
        $brand = Db::table('goods_units')->query($sql);
        return $this->fetch('units_list',['list' =>$brand]);
    }
    //修改
    public function units_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\GoodsUnits();
            $data=$model->find(input('units_id'));
            $this->assign('data',$data);
            return $this->fetch();
        }elseif(request()->isPost()){
            $model=new \app\index\model\GoodsUnits();
            $data=request()->post();
            $re = $model->update($data);
            if($re){
                $this->success('修改成功',url('units_list'));
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除
    public function units_delete(){
        $re=Db::name('goods_units')->delete(input('units_id'));
        if($re){
            $this->success('删除成功','units_list');
        }else{
            $this->error('删除失败');
        }
    }
}