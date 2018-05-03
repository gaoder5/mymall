<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/25
 * Time: 14:27
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class GoodsType extends Controller{
    public function type_list(){
      $list = Db::name('goods_type')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function type_add(){
            $model = new \app\index\model\GoodsType();
            if (request()->isGet()){
                return $this->fetch();
            }else{
                $data = request()->post();
                $re = $model->save($data);
                if($re){
                    $this->success('添加成功',url('type_list'));
                }else{
                    $this->error('添加失败');
                }
            }
    }
    //模糊查询
    public function search(){
        $content = $_POST['aa'];
        $sql = "select * from `s_goods_type` where `type_name` like '%".$content."%'";
        $brand = Db::table('goods_type')->query($sql);
        return $this->fetch('type_list',['list' =>$brand]);
    }
    //修改
    public function type_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\GoodsType();
            $data=$model->find(input('type_id'));
            $this->assign('data',$data);
            return $this->fetch();
        }elseif(request()->isPost()){
            $model=new \app\index\model\GoodsType();
            $data=request()->post();
            $re = $model->update($data);
            if($re){
                $this->success('修改成功',url('type_list'));
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除
    public function type_delete(){
        $re=Db::name('goods_type')->delete(input('type_id'));
        if($re){
            $this->success('删除成功','type_list');
        }else{
            $this->error('删除失败');
        }
    }
}