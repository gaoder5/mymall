<?php
/**
 * Created by PhpStorm.
 * User: 安琦
 * Date: 2018/4/19
 * Time: 14:50
 */
namespace app\index\model;

use think\Model;

class AdminUser extends Model{
    public function login($username,$password){//传递两个参数
        //查询数据where（'user_name','=',$username）数据表字段user_name=$username提交过来的参数值
        $admin = \think\Db::name('admin_user')->where('user_name','=',$username)->find();
        if($admin){
            //如果用户名和密码正确
            if($admin['password']==md5($password)){
                return '1';
            }else{
                return '2';
            }
        }else{
            return 3;
        }

    }
}