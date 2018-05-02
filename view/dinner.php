<?php
include '../helper/checkLogin.php';
require_once '../helper/functions.php';
header('content-type:text/html; charset=utf8');
$start_time = '09:00'; //每天订餐开始时间
$end_time = '17:30';
$validate_time = time_validate('09:00:00', '17:30:00');
$pro_name = isset($_COOKIE['pro_name']) ? $_COOKIE['pro_name'] : '';
$pro_pass = isset($_COOKIE['pro_pass']) ? $_COOKIE['pro_pass'] : '';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//Dtd HTML 4.01 Transitional//EN" "http://www.w3c.org/tr/1999/REC-HTML401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xHTML">
    <head>
        <title>任务管理系统</title>
        <meta http-equiv=Content-Type content="text/HTML; charset=utf-8">
        <link href="../public/css/pm.css" type=text/css rel=stylesheet>
        <link rel="stylesheet" type="text/css" href="../public/css/nav.css">
        <style>
            .butt{
                display: inline;
                cursor: pointer;
                font-size: 14px;
                font-family: \5FAE\8F6F\96C5\9ED1, \5B8B\4F53;
                border: none;
                width: 80px;
                height: 30px;
                background: url(../public/image/button.gif) no-repeat left top;
                margin-bottom: 20px;
            }
            .butt:hover {
                background: url(../public/image/button_hover.gif) no-repeat left center;
            }
            div.butt {
                position: absolute;
                top: 150px;
                left: 380px;
            }
            div.butto{ position: absolute;
                top: 150px;
                left: 320px;
                font-size: large
            }
            #record-list {
                text-align: center;
            }
            #record-list {
                font: 18px 隶书, \4EFF\5B8B;
                position: absolute;
                top: -100px;
                left: 780px;
                letter-spacing: -0.4px;
            }
            #record-list h2 .count {
                font-size: 50px;
            }
            #record-list .count {
                font: 1.6em 'showcard gothic', georgia;
                padding: 0 4px;
                color: green;
            }
            #record-list dl {
                margin-bottom: 10px;
                padding-bottom: 20px;
            }
            #record-list dt {
                font-size: 15px;
                letter-spacing: -0.2px;
            }
            #record-list dd {
                padding: 2px 0;
            }

        </style>
    </head> 
<!--    加载完后执行js的show函数-->
    <body onload=show()>
    <ul class="nav">
        <li><a href="index.php">任务系统</a></li>
        <li><a href="dinner.php">订餐系统</a></li>
        <li><a href="">图书系统</a></li>
    </ul>
    <table class="margin-top b" id=Nav cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tr><td background="../public/image/nav_bg.gif" width="760px" height="30px"><span style="margin-left:10px">技术部订餐管理 > <span id="two">订餐首页</span></span></td></tr>
        </table>
        <table class=margin-top cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tbody>
                <tr>
                    <td valign=top width=195 height=292>

                    </td>
                    <td vAlign=top>
                        <table id=__01 height=338 cellSpacing=0 cellPadding=0 width=564 border=0>
                            <tbody>
                                <tr>
                                    <td style="padding: 12px 35px 5px 65px;" background=../public/image/list_01.gif>
                                        <div class="l colorfe5705 b font14">订餐系统</div>
                                        <div class=r>
                                            <div id='time'></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 10px 20px" vAlign=top background=../public/image/list_bg.gif height=263>
                                                        <table>
                                                            <tr>
                                                                <td>您好！<?php echo $userInfo['username']?>！！<font color=red><tmpl_var name=name></font> 欢迎使用技术部订餐系统，请选择左边的菜单开始操作。 </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <p>注意:我们的订餐时间是在<strong class="time" style="color: red"><?php echo $start_time.'-'.$end_time?></strong></p>
                                                                    <p>过了这个时间就不能再定了</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                  <td valign=top align=middle background=../public/image/list_03.gif height=39>&nbsp;</td>
                                </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        </table>
        <?php include('layout/footer.php')?>


    <?php if ($validate_time): ?>
        <form id="dinnerForm" name="dinnerForm" action="" method="post">
            <div class="butt" >
                <input  type="submit" name="reserve" id="reserve" class="butt" value="订餐"  onclick="sm1()" />
                <input type="submit" name="unreserve" id="unreserve" class="butt" value="退订"  onclick="sm1()" />
                <input type="submit" name="quitout" id="quitout" class="butt" value="退出"  onclick="return confirm('确定退出吗?')" formaction="../controller/login.php?out=yes" />
                <p class="input" style="float:left">
                    <label for="code">验证码</label>
                    <input type="text" name="code" id="code" class="text" style="width:110px;"/>
                </p>
                <div style="width:200px;height:30px;border:1px;">
                    <div style="width:100px;height:50px; border:1px black;float:bottom;">
                        <img src="../helper/code.php?" onclick="this.src=this.src	+Math.random()"/>
                        <label style="float: left"> 点击图片刷新</label>
                    </div>

                </div>
        </form>

    <?php else: ?>
        <form id="dinnerForm" name="dinnerForm" action="" method="post">
            <div class="butt" >
                <input  type="submit" name="reserve" id="reserve" class="butt" value="不能订餐"  onclick="return confirm('已超过订餐时间，不能订餐了')" formaction="dinner.php"  />
                <input type="submit" name="unreserve" id="unreserve" class="butt" value="不可退订"  onclick="return confirm('已超过订餐时间，不可退订')" formaction="dinner.php" />
                <input type="submit" name="quitout" id="quitout" class="butt" value="退出"  onclick="return confirm('确定退出吗?')" formaction="../controller/login.php?out=yes" />
                <p class="input" style="float:left">
                    <label for="code">验证码</label>
                    <input type="text" name="code" id="code" class="text" style="width:110px;"/>
                </p>
                <div style="width:200px;height:30px;border:1px;">
                    <div style="width:100px;height:50px; border:1px black;float:bottom;">
                        <img src="../helper/code.php?" onclick="this.src=this.src	+Math.random()"/>
                        <label style="float: left"> 点击图片刷新</label>
                    </div>

                </div>
        </form>
    <?php endif; ?>

        <div id="record-list">
    <?php

    $records = get_records();

        echo '<h2 >共有<em class="count">' . count($records) . '</em>人订餐</h2>';
    $records = filter_records($records);//也就是把所有今天订餐的人按部分变成一个二维数组

    foreach (array_keys($records) as $v) {

        if (array_key_exists($v, $records)) {

            echo '<dl >';

            echo '<dt>' . $v . '<em class="count">' . count($records[$v]) . '</em>人订餐</dt>';//$v 是部门名称

            foreach ($records[$v] as $value) {

                //$records是一个按部门来分的一个二维数组

                echo "<dd>{$value['username']} {$value['time']}</dd>";

            };
            echo '</dl>';
        }
    };
    ?>
        </div>

    
        <script src="../public/js/jquery-2.1.1.min.js"></script>
        <script src="../public/js/time.js"></script>
        <script src="../public/js/dinner.js"></script>
        <script>
            $('#menu1').addClass('CurrentSubMenu');
        </script>
    </body>
</html>

