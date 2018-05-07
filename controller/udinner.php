<?php
require_once '../helper/functions.php';
header("content-type:text/html;charset=utf-8");  
$start_time = '08:00'; //每天订餐开始时间
$end_time = '17:30';
$validate_time = time_validate('08:00:00', '17:30:00');

session_start();
$_POST = array_merge($_POST, $_GET);
$pro_name = isset($_COOKIE['pro_name']) ? $_COOKIE['pro_name'] : '';
$pro_pass = isset($_COOKIE['pro_pass']) ? $_COOKIE['pro_pass'] : '';
$uid = check_user_info($pro_name,$pro_pass);


//大前提，订餐时间内才有效

if($validate_time) {


    //第二个前提，类型为订餐、退订的时候才有效

    if (isset($_POST['reserve']) || isset($_POST['unreserve'])) {
//      判断验证码不为空
        if(!isset($_POST['code']) || empty($_POST['code']) ) {notice('验证码为空！！');}
        //判断用户名，密码是否正确，正确则返回用户id，里面已经判断了是否记住姓名密码

        $uid = check_user_info($pro_name, $pro_pass);

        //判断验证码是否正确
        $code = $_SESSION['code'];
        //echo $code."----";
        $input = $_POST['code'];
        //echo $input;

        //将$code和$input全部转化成小写字母来比较
        $code = strtolower($code);
        $input = strtolower($input);
        if ($code != $input) {

            notice_href('验证码错误！！');
        } else {
            //判断用户是否已订餐
            $user_record = check_user_record($uid);

            //如果是订餐
            if (isset($_POST['reserve'])) {
                if ($user_record) {

                    notice_href('你已经点过了，不可以重复订餐！！');

                } else {
                    $add = add_record($uid);

                    if ($add) {

                        notice_href('订餐成功！！');

                    }

                    notice_href('订餐失败，请重试！！');

                }
            } elseif (isset($_POST['unreserve'])) {
                if (!$user_record) {

                    notice_href('你还没有订餐！！');

                } else {

                    $cancle = cancle_record($uid);

                    if ($cancle) {

                        notice_href('取消订餐成功！！');

                    }

                    notice_href('取消订餐失败，请重试！！');

                }
            } else {
                notice_href('提交类型错误！');
            }
        }
    }
}
else{
    notice_href('Sorry，不在订餐时间内！');
}

