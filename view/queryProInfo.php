<?php
    include '../helper/checkLogin.php';
    include '../controller/queryPro.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//Dtd HTML 4.01 Transitional//EN" "http://www.w3c.org/tr/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xHTML">
    <head>
        <title>项目管理系统</title>
        <meta http-equiv=Content-Type content="text/HTML; charset=utf-8">
        <link href="../public/css/pm.css" type=text/css rel=stylesheet>
        <link rel="stylesheet" type="text/css" href="../public/css/nav.css">
    </head>
    <body onload=show()>
        <ul class="nav">
        <li><a href="index.php">任务系统</a></li>
        <li><a href="dinner.php">订餐系统</a></li>
        <li><a href="">图书系统</a></li>
        </ul>
        <!-- <table class=margin-top cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tbody>
            <tr>
                <td width=380><img height=61 alt=技术部项目开发/修改系统 src="../public/image/logo.gif" width=236 border=0></td>
            </tr>
            </tbody>
        </table> -->
        <table class="margin-top b" id=Nav cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tr><td background="../public/image/nav_bg.gif" width="760px" height="30px"><span style="margin-left:10px">技术部任务管理 > <span id="two">任务查询</span></span></td></tr>
        </table>
        <table class=margin-top cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tbody>
                <tr>
                    <td vAlign=top width=195 height=292>
                        <?php include('layout/menu.php')?>
                    </td>
                    <td vAlign=top>
                        <table id=__01 height=338 cellSpacing=0 cellPadding=0 width=564 border=0>
                            <tbody>
                                <!--框的头部-->
                                <tr>
                                    <td style="padding: 12px 35px 5px 65px" background=../public/image/list_01.gif>
                                        <div class="l colorfe5705 b font14">技术部任务单--任务查询</div>
                                        <div id="time" style="float: right"></div>
                                    </td>
                                </tr>
                                <!--框的中间-->
                                <tr>
                                    <td>
                                        <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                                            <tbody>
                                                <tr>
                                                    <!--框的两边-->
                                                    <td style="padding: 10px 20px;height: 263px" valign=top background="../public/image/list_bg.gif">
    <table style="width: 530px;text-align:center">
        <tr>
            <td>编号</td>
            <td>项目名称</td>
            <td>负责人</td>
            <td>开始时间</td>
            <td>完成时间</td>
            <td>部门</td>
            <td>操作</td>
        </tr>
        <?php foreach($result as $pro){?>
	<tr>
            <td><?php echo $pro['number'];?></td>
            <td><?php echo $pro['name'];?></td>
            <td><?php echo $pro['username'];?></td>
            <td><?php echo $pro['date'];?></td>
            <td><?php echo $pro['end_time'];?></td>
            <td><?php echo $pro['depart'];?></td>
            <td><a href="queryProDetail.php?id=<?php echo $pro['id']?>" target="_blank">详情</a></td>
        </tr>
        <?php }?>

    </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!--框的底部-->
                                <tr>
                                    <td vAlign=top align=middle background=../public/image/list_03.gif height=39>&nbsp;</td>
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
            $(document).ready(function(){ 
                $('#menu3').addClass('CurrentSubMenu');

  
            });
        </script>
    </body>
</html>
