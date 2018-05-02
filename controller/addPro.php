<?php
header('content-type:text/html; charset=utf8');
include '../helper/checkLogin.php';

if(empty($_POST['number']) ) {
    notice('编码为空，请刷新！！');
}else{
    $number = $_POST['number'];
}
if(!isset($_POST['departId']) || empty($_POST['departId']) ) {
    notice('请选择一个部门！！');
}else{
    $departId = $_POST['departId'];
}
if(empty($_POST['proName']) ) {
    notice('请填写项目名称！！');
}else{
    $proName= trim($_POST['proName']);
}
if(empty($_POST['proUsername']) ) {
    notice('负责人不能为空！！');
}else{
    $proUsername = trim($_POST['proUsername']);
}
if(empty($_POST['year']) || empty($_POST['month']) || empty($_POST['day'])){
    notice('请选择预期结束日期！！');
}else{
    $endTime = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
    if(strtotime($endTime) < strtotime(date('Y-m-d'))){
        notice('预期结束日期不能早于今天');
    }
}
if(empty($_POST['proContent']) ) {
    notice('请填写任务内容！！');
}else{
    $proContent = trim($_POST['proContent']);
}
if(empty($_POST['departGm']) ) {
    notice('部门经理不能为空！！');
}else{
    $departGm = trim($_POST['departGm']);
}
if(empty($_POST['checkUsername']) ) {
    notice('审核人不能为空！！');
}else{
    $checkUsername= trim($_POST['checkUsername']);
}

$id = addPro($number,$departId,$proName,$proUsername,$endTime,$proContent,$departGm,$checkUsername,$userInfo['id']);
if(!$id){
    notice('任务添加失败！！');
}
notice('任务添加成功！','../view/addPro.php?id='.$id);