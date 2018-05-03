<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/26
 * Time: 13:40
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class ActivityCard extends Controller{
    public function card_list(){
       $list = Db::name('activity_card')->select();
       $this->assign('list',$list);
       return $this->fetch();
    }
    public function card_add(){
        $model = new \app\index\model\ActivityCard();
        if(request()->isGet()){
            return $this->fetch();
        }else{
            $data = request()->post();
            $file = request()->file('card_img');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $data['card_img']=$info->getSaveName();
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('card_list'));
            }else{
                $this->error('添加失败');
            }
        }
    }
    //修改
    public function card_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\ActivityCard();
            $id = input('card_id');
            $data=$model->find($id);
            $this->assign('data',$data);
            return $this->fetch();
        }elseif (request()->isPost()){
            $model=new \app\index\model\ActivityCard();
            $data=request()->post();
            if ($file = request()->file('card_img')){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                $str=$info->getSaveName();
                $data['card_img']=$str;
                $re = Db::name('activity_card')->where('card_id',$data['card_id'])->update($data);
                if($re){
                    $this->success('修改成功',url('card_list'));
                }else{
                    $this->error('修改失败');
                }
            }else{
                $data=request()->post();
                $re = Db::name('activity_card')->where('card_id',$data['card_id'])->update($data);
                if($re){
                    $this->success('修改成功',url('card_list'));
                }else{
                    $this->error('修改失败');
                }
            }
        }
    }
    //模糊查询
    public function search(){
        $content = $_POST['aa'];
        $sql = "select * from `s_activity_card` where `card_name` like '%".$content."%'";
        $brand = Db::table('activity_card')->query($sql);
        return $this->fetch('card_list',['list' =>$brand]);
    }
    public function delete(){
        if(request()->isGet()){
            $id=input('card_id');
            $re=model('activity_card')->get($id)->delete();
            if($re){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }

    }
}