<?php
session_start();
header('content-type:text/html; charset=utf8');
include 'mysql.php';
if(!isset($_SESSION['pro_user']) || empty($_SESSION['pro_user'])) {
    notice('请先登录！','../index.php');
}
$userInfo = $_SESSION['pro_user'];