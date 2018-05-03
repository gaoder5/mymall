<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/26
 * Time: 16:11
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class ActivityGroup extends Controller{
    public function group_list(){
        $list = Db::name('activity_group')->select();
        foreach ($list as $k=>$v) {
            $date = Db::name('goods')->where(['goods_id' => $v['goods_id']])->find();
            $v['goods_id'] = $date['goods_name'];
            $list[$k]=$v;
        }
        $this->assign('list',$list);
        $count = Db::name('activity_group')->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    public function group_add(){
        $model = new \app\index\model\ActivityGroup();
        if (request()->isGet()){
            $date = Db::name('goods')->select();
            $this->assign('data',$date);
            return $this->fetch();
        }else{
            $data = request()->post();
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('group_list'));
            }else{
                $this->error('添加失败');
            }
        }
    }
    //模糊查询
    public function search(){
        $content = $_POST['aa'];
        $sql = "select * from `s_activity_group` where `goods_id` like '%".$content."%'";
        $brand = Db::table('activity_group')->query($sql);
        return $this->fetch('group_list',['list' =>$brand]);
    }
    //修改
    public function group_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\ActivityGroup();
            $list = Db::name('goods')->select();
            $this->assign('list',$list);
            $data=$model->find(input('group_id'));
            $this->assign('data',$data);
            return $this->fetch();
        }elseif(request()->isPost()){
            $model=new \app\index\model\ActivityGroup();
            $data=request()->post();
            $re = $model->update($data);
            if($re){
                $this->success('修改成功',url('group_list'));
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除
    public function delete(){
        $re=Db::name('activity_group')->delete(input('group_id'));
        if($re){
            $this->success('删除成功','group_list');
        }else{
            $this->error('删除失败');
        }
    }
}