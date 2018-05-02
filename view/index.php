<?php
    include '../helper/checkLogin.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//Dtd HTML 4.01 Transitional//EN" "http://www.w3c.org/tr/1999/REC-HTML401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xHTML">
    <head>
        <title>任务管理系统</title>
        <meta http-equiv=Content-Type content="text/HTML; charset=utf-8">
        <link href="../public/css/pm.css" type=text/css rel=stylesheet>
        <link rel="stylesheet" type="text/css" href="../public/css/nav.css">
    </head>
<!--    加载完后执行js的show函数--> 
    <body onload=show()>
    <ul class="nav">
        <li><a href="index.php">任务系统</a></li>
        <li><a href="dinner.php">订餐系统</a></li>
        <li><a href="">图书系统</a></li>
    </ul>
   <!--  <table class=margin-top cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tbody>
                <tr>
                    <td width=380><img height=61 alt=技术部任务管理系统 src="../public/image/logo.gif" width=236 border=0></td>
                </tr>
            </tbody>
        </table> -->
        <table class="margin-top b" id=Nav cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tr><td background="../public/image/nav_bg.gif" width="760px" height="30px"><span style="margin-left:10px">技术部任务管理 > <span id="two">管理首页</span></span></td></tr>
        </table>
        <table class=margin-top cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tbody>
                <tr>
                    <td valign=top width=195 height=292>
                    <?php include('layout/menu.php')?>
                    </td>
                    <td vAlign=top>
                        <table id=__01 height=338 cellSpacing=0 cellPadding=0 width=564 border=0>
                            <tbody>
                                <tr>
                                    <td style="padding: 12px 35px 5px 65px;" background=../public/image/list_01.gif>
                                        <div class="l colorfe5705 b font14">任务管理系统</div>
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
                                                                <td>您好！<?php echo $userInfo['username']?>！！<font color=red><tmpl_var name=name></font> 欢迎使用技术部任务管理系统，请选择左边的菜单开始操作。 </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
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
    <script src="../public/js/jquery-2.1.1.min.js"></script>
        <script src="../public/js/time.js"></script>
        <script>
            $('#menu1').addClass('CurrentSubMenu');
        </script>
    </body>
</html>

