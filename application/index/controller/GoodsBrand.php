<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/20
 * Time: 9:34
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class GoodsBrand extends Controller{
    //展示品牌列表
    public function product_brand(){
        $list=Db::name('goods_brand')->select();
        return $this->fetch('product_brand',['list'=>$list]);
    }
    public function brand_add(){
        $model = new \app\index\model\GoodsBrand;
        if(request()->isGet()){
            return $this->fetch();
        }else{
            $data = request()->post();
            $file = request()->file('brand_logo');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $data['brand_logo']=$info->getSaveName();
            $re = $model->save($data);
            if($re){
                $this->success('添加成功',url('product_brand'));
            }else{
                $this->error('添加失败');
            }
        }

    }
    //修改
    public function brand_edit(){
        if(request()->isGet()){
            $model=new \app\index\model\GoodsBrand;
            $id = input('brand_id');
            $data=$model->find($id);
            $this->assign('data',$data);
            return $this->fetch();
        }elseif (request()->isPost()){
            $model=new \app\index\model\GoodsBrand;
            $data=request()->post();
            if ($file = request()->file('brand_logo')){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                $str=$info->getSaveName();
                $data['brand_logo']=$str;
                $re = Db::name('goods_brand')->where('brand_id',$data['brand_id'])->update($data);
                if($re){
                    $this->success('修改成功',url('product_brand'));
                }else{
                    $this->error('修改失败');
                }
            }else{
                $data=request()->post();
                $re = Db::name('goods_brand')->where('brand_id',$data['brand_id'])->update($data);
                if($re){
                    $this->success('修改成功',url('product_brand'));
                }else{
                    $this->error('修改失败');
                }
            }
        }
    }
    //模糊查询
    public function search(){
        $content = $_POST['aa'];
        $sql = "select * from `s_goods_brand` where `brand_name` like '%".$content."%'";
        $brand = Db::table('goods_brand')->query($sql);
        return $this->fetch('product_brand',['list' =>$brand]);
    }

    public function delete(){
        if(request()->isGet()){
            $id=input('brand_id');
            $re=model('goods_brand')->get($id)->delete();
            if($re){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }

    }




}