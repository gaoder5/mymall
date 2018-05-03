<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/26
 * Time: 14:14
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class ActivityFavourable extends Controller{
    public function favourable_list(){
        $list = Db::name('activity_favourable')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function favourable_add(){
        $model = new \app\index\model\ActivityFavourable();
        if (request()->isGet()){
            return $this->fetch();
        }else{
            $data = request()->post();
            if($data['act_range']==0){
                $data = Db::name('goods')->select();
            }elseif ($data['act_range']==1){
                $data = Db::name('goods_category')->select();
                foreach ($data as $k=>$v){
                    $v['id']=$v['cat_id'];
                    $v['name']=$v['cat_name'];
                    $data[$k]=$v;
                }
                echo json_encode($data);

            }elseif ($data['act_range']==2){
                $data = Db::name('goods_brand')->select();
                foreach ($data as $k=>$v){
                    $v['id']=$v['brand_id'];
                    $v['name']=$v['brand_name'];
                    $data[$k]=$v;
                }
                echo json_encode($data);
            }else{
                $data=Db::name('goods')->select();
                foreach ($data as $k=>$v){
                    $v['id']=$v['goods_id'];
                    $v['name']=$v['goods_name'];
                    $data[$k]=$v;
                }
                echo json_encode($data);
            }
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('favourable_list'));
            }else{
                $this->error('添加失败');
            }
        }
    }
    //修改
    public function score_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\ActivityFavourable();
            $data=$model->find(input('act_id'));
            $this->assign('data',$data);
            return $this->fetch();
        }elseif(request()->isPost()){
            $model=new \app\index\model\ActivityFavourable();
            $data=request()->post();
            $re = $model->update($data);
            if($re){
                $this->success('修改成功',url('favourable_list'));
            }else{
                $this->error('修改失败');
            }
        }
    }
    //删除
    public function delete(){
        $data=request()->post();
        $re=Db::name('activity_favourable')->delete(input('act_id'));
        if($re){
            $this->success('删除成功','favourable_list');
        }else{
            $this->error('删除失败');
        }
    }

}