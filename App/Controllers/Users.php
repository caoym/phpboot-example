<?php

namespace App\Controllers;
use App\Hooks\BasicAuth;

/**
 * @path users
 */
class Users
{
    /**
     * 通过实现BasicAuth 演示 hook 的使用
     * 此接口在浏览器访问, 将弹出密码输入框, 用户名密码在 config.php 中配置
     * @hook \App\Hooks\BasicAuth
     */
    public function getCurrentUser(){
        return ['username'=>'guest'];
    }
}