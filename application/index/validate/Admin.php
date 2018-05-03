<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 2018/4/25
 * Time: 9:14
 */
namespace app\index\validate;
use think\Validate;

class Admin extends Validate{
        protected   $rule = [
          'auth_name'  => 'require|unique',
          'auth_a'   => 'require',
        ];

}