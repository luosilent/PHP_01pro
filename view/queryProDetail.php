<?php
    include '../helper/checkLogin.php';
    $id = isset($_GET['id'])?$_GET['id']:'';
    $pro = getProById($id);
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
                                                        <!--添加表单-->
                                                        <?php if(!empty($pro)){?>

<table style="width: 450px;margin:0 35px;">
        <tr>
            <td style="width: 30%;"><span style="float: right">编号：</span></td>
            <td style="width: 20%;"><?php echo $pro['number'];?></td>
            <td style="width: 25%;"><span style="float: right">日期：</span></td>
            <td style="width: 25%;"><?php echo $pro['date'];?></td>   
        </tr>
        <tr>
            <td><span style="float: right">部门：</td>
            <td colspan="3"><?php echo $pro['depart'];?></td>
        </tr>
        <tr>
            <td><span style="float: right">任务名称：</span></td>
            <td colspan="3"><?php echo $pro['name'];?></td>
        </tr>
        <tr>
            <td><span style="float: right">任务负责人：</span></td>
            <td colspan="3"><?php echo $pro['username'];?></td>
        </tr>
        <tr>
            <td><span style="float: right">预计完成日期：</span></td>
            <td colspan="3">
              <?php echo $pro['end_time']?>
            </td>
        </tr>
        <tr>
            <td><span style="float: right">任务内容：</span></td>
            <td colspan="4"><?php echo $pro['content'];?></td>
        </tr>
        <tr>
            <td><span style="float: right">部门经理：</span></td>
            <td><?php echo $pro['depart_gm'];?></td>
            <td><span style="float: right">审核：</span></td>
            <td><?php echo $pro['check_username'];?></td>
        </tr>
<!--        <tr>
            <td  colspan="4" style="text-align: center"><a href="javascritp:void(0);" style="color: red;font-size: 15px" id="back"><b>返回</b></a></td>
        </tr>-->
        <tr>
            <td  colspan="4" style="text-align: center"><a href="javascritp:void(0);" style="color: red;font-size: 15px" id="back"><b>关闭网页</b></a></td>
        </tr>
    </table>
                                                        <?php }?>
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
                $('#back').click(function(){
//                    window.history.go(-1);
                    //关闭当前网页
                    window.opener=null;
                    window.open('','_self');
                    window.close();
                })
            });
        </script>
    </body>
</html>
