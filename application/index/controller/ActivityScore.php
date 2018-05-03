<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/26
 * Time: 15:59
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class ActivityScore extends Controller{
    public function score_list(){
        $list = Db::name('activity_score')->select();
        foreach ($list as $k=>$v) {
            $date = Db::name('goods')->where(['goods_id' => $v['goods_id']])->find();
            $v['goods_id'] = $date['goods_name'];
            $list[$k]=$v;
        }
        $this->assign('list',$list);
        $count = Db::name('activity_bonus')->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    public function score_add(){
        $model = new \app\index\model\ActivityScore();
        if (request()->isGet()){
            $date = Db::name('goods')->select();
            $this->assign('data',$date);
            return $this->fetch();
        }else{
            $data = request()->post();
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('score_list'));
            }else{
                $this->error('添加失败');
            }
        }
    }
    //修改
    public function score_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\ActivityScore();
            $list = Db::name('goods')->select();
            $this->assign('list',$list);
            $data=$model->find(input('score_id'));
            $this->assign('data',$data);
            return $this->fetch();
        }elseif(request()->isPost()){
            $model=new \app\index\model\ActivityScore();
            $data=request()->post();
            $re = $model->update($data);
            if($re){
                $this->success('修改成功',url('score_list'));
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除
    public function delete(){
        $re=Db::name('activity_score')->delete(input('score_id'));
        if($re){
            $this->success('删除成功','score_list');
        }else{
            $this->error('删除失败');
        }
    }
}