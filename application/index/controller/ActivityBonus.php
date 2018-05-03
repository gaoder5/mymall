<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/26
 * Time: 15:28
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class ActivityBonus extends Controller{
        public function bonus_list(){
            $list = Db::name('activity_bonus')->select();
            $this->assign('list',$list);
            $count = Db::name('activity_bonus')->count();
            $this->assign('count',$count);
            return $this->fetch();
        }
    public function bonus_add(){
        $model = new \app\index\model\ActivityBonus();
        if (request()->isGet()){
            $date = Db::name('activity_bonus')->select();
            $this->assign('data',$date);
            return $this->fetch();
        }else{
            $data = request()->post();
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('bonus_list'));
            }else{
                $this->error('添加失败');
            }
        }
    }
    //模糊查询
    public function search(){
        $content = $_POST['aa'];
        $sql = "select * from `s_activity_bonus` where `type_name` like '%".$content."%'";
        $brand = Db::table('activity_bonus')->query($sql);
        return $this->fetch('bonus_list',['list' =>$brand]);
    }
    //修改
    public function bonus_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\ActivityBonus();
            $data=$model->find(input('type_id'));
            $this->assign('data',$data);
            return $this->fetch();
        }elseif(request()->isPost()){
            $model=new \app\index\model\ActivityBonus();
            $data=request()->post();
            $re = $model->update($data);
            if($re){
                $this->success('修改成功',url('bonus_list'));
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除
    public function delete(){
        $re=Db::name('activity_bonus')->delete(input('type_id'));
        if($re){
            $this->success('删除成功','bonus_list');
        }else{
            $this->error('删除失败');
        }
    }
}