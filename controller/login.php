<?php
session_start();
header('content-type:text/html; charset=utf8');
require_once '../helper/mysql.php';
//退出登录
if(isset($_GET['out']) && $_GET['out'] == 'yes' ) {
    unset($_SESSION["pro_user"]);
    notice('','../index.php');
}
//登录


switch ($_POST['type']) {
    case 'login':
        if(!isset($_POST['username']) || empty($_POST['username']) ) {notice('姓名不能为空！！');}
        if(!isset($_POST['password']) || empty($_POST['password']) ) {notice('密码不能为空！！');}
        $result = checkUserExists($_POST['username'],$_POST['password']);//用户信息数组或者false
        if(!$result){
            notice('帐号密码错误！！');
        }
        if(isset($_POST['remember']) && !empty($_POST['remember'])){
            setCookieInfo('pro_name',$_POST['username']);
            setCookieInfo('pro_pass', $_POST['password']);
        }else{
            deleteCookieInfo('pro_name');
            deleteCookieInfo('pro_pass');
        }
        //用户信息保存到session中，关联数组形式
        $_SESSION["pro_user"] = $result;
        notice('登录成功！！','../view/index.php');
        break;
    case 'register':
        if(!isset($_POST['username']) || empty($_POST['username']) ) {notice('姓名不能为空！！','../index.php?type=register');}
        if(!isset($_POST['password']) || empty($_POST['password']) ) {notice('密码不能为空！！','../index.php?type=register');}
        if(!isset($_POST['password2']) || empty($_POST['password2']) ) {notice('确认密码不能为空！！');}
        if(strcmp(trim($_POST['password']), trim($_POST['password2'])) != 0 ){
            notice('两次密码不匹配！！');
        }
        if(!isset($_POST['depart_id']) || empty($_POST['depart_id']) ) {notice('请选择一个部门！！');}
        if(checkUsernameExists($_POST['username'])){
            notice('用户名已存在！！');
        }
        $result = insertUserInfo(trim($_POST['username']),trim($_POST['password']),$_POST['depart_id']);
        if($result){
            notice('注册成功，请登录！！','../index.php');
        }
        notice('注册失败，请重新注册！！');
        break;
    default:
        notice('类型错误！');
        break;
}
