<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/18
 * Time: 14:37
 */
namespace app\index\controller;
use Codeception\PHPUnit\Constraint\Page;
use think\Controller;
use think\Db;
use Think\Db\Driver\Pdo;
use think\Request;

class System extends Controller{
    //批量删除
    function mutildel(){
//        /a返回的是数组
        Db::name('friend_link')->delete(input('selected/a',[]));
        $this->redirect('link_list');
    }
//    友情链接
    function link_list(){
        $limit=3;
        $list=Db::name('friend_link')->paginate($limit);
//        dump($list);exit;
        return $this->fetch('link_list',['list'=>$list]);

    }
//    添加友情链接
    function link_add(){
        return $this->fetch();
    }
//    添加保存友情链接
    function link_addSave(){
//        $model=model('friend_link');
        $data=request()->post();
        $file=request()->file('link_logo');
        if($file){
            $info=$file->move(ROOT_PATH.'public/uploads');
            if($info){
                if($data){
                    $data['link_logo']=$info->getSaveName();
                    Db::name('friend_link')->insert($data);
//                    $model->save($data);
                    $this->success('添加成功','System/link_list');
                }else{
                    $this->error('添加失败1');
                }
            }else{
                $data['link_logo']="";
                Db::name('friend_link')->insert($data);
//                $model->save($data);
                $this->success('添加成功','System/link_list');
            }
        }else{
            if($data){
                Db::name('friend_link')->insert($data);
//                $model->save($data);
                $this->success('添加成功','System/link_list');
            }else{
                $this->error('添加失败2');
//                dump($data);
            }
        }
    }
//    修改友情链接
    function link_edit(){
        if(request()->input('id')){
            $data=Db::name('friend_link')->find(input('id'));
            $this->assign('data',$data);
            return $this->fetch();
        }else{
            $this->error('获取数据失败');
        }
    }
    function link_editSave(){
        $data=request()->post();
        if($_FILES['link_logo']['tmp_name']!=''){
            $file=request()->file('link_logo');
            $info=$file->move(ROOT_PATH.'public/uploads');
            $data['link_logo']=$info->getSaveName();
        }
        $re=Db::name('friend_link')->update($data);
        if($re){
            $this->success('编辑成功','System/link_list');
        }else{
            $this->error('编辑失败');
        }
    }
//    删除友情链接
    function link_delete(){
        $re=Db::name('friend_link')->delete(input('id'));
        if($re){
            $this->success('删除成功','System/link_list');
        }else{
            $this->error('删除失败');
        }
    }

//    展示配送地区
    public function area_list(){
        $pro=Db::name('address_provinces')->select();
        $city=Db::name('address_cities')->select();
        $this->assign('pro',$pro);
        $this->assign('city',$city);
        return $this->fetch();
    }
    public function getCity(){
        Request::instance()->param();
        if(request()->isPost()){
            $pid=input('pro');
            $a['provinceid']=$pid;
            $city=Db::name('address_cities')->where($a)->select();
            return json($city);
        }
    }
    public function getArea(){
        Request::instance()->param();
        if(request()->isPost()){
            $cid=input('city');
            $a['cityid']=$cid;
            $area=Db::name('address_areas')->where($a)->select();
            return json($area);
        }
    }
//    展示配送方式
    function method_list(){
        $limit=3;
        $list=Db::name('goods_shipping')->paginate($limit);
        return $this->fetch('method_list',[
            'list'=>$list
        ]);
    }
    function method_add(){
        return $this->fetch();
    }
    function method_addSave(){
        $data=\request()->post();
        if($data){
            $re=Db::name('goods_shipping')->insert($data);
            if($re){
                $this->success('添加成功','System/method_list');
            }else{
                $this->error('添加不成功');
            }
        }else{
            $this->error('添加失败');
        }
    }
    function method_edit(){
        if(\request()->input('id')){
            $data=Db::name('goods_shipping')->find(input('id'));
            $this->assign('data',$data);
            return $this->fetch();
        }else{
            $this->error('获取数据失败');
        }
    }
    function method_editSave(){
        $data=\request()->post();
        $re=Db::name('goods_shipping')->update($data);
        if($re){
            $this->success('修改成功','System/method_list');
        }else{
            $this->error('修改不成功');
        }

    }
    function method_delete(){
        $re=Db::name('goods_shipping')->delete(input('id'));
        if($re){
            $this->success('删除成功','System/method_list');
        }else{
            $this->error('删除失败');
        }
    }
    //批量删除友情链接
    function delCheck(){
        $ids = implode(',',$_POST['checks']);//将数组转化成字符串
        if(isset($ids)){
            if(Db::name('friend_link')->delete($ids)){
                $this->success('删除成功','System/link_list');
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('删除数据不存在');
        }
    }
    //批量删除配送方式
    function delMethod(){
        $ids = implode(',',$_POST['checks']);//将数组转化成字符串
        if(isset($ids)){
            if(Db::name('goods_shipping')->delete($ids)){
                $this->success('删除成功','System/method_list');
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('删除数据不存在');
        }
    }
}