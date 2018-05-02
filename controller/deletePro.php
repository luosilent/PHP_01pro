<?php
header('content-type:text/html; charset=utf8');
include '../helper/checkLogin.php';
$date = 'false';

if(isset($_POST['id'])) {//有值
    $result = deleteProById($_POST['id']);
    if($result){
        $date = 'success';
    }
}
echo json_encode($date);




