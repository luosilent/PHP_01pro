<?php
    include '../helper/checkLogin.php';
    $depart = getAllDepart();
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
    <ul class="nav">
        <li><a href="index.php">任务系统</a></li>
        <li><a href="dinner.php">订餐系统</a></li>
        <li><a href="">图书系统</a></li>
    </ul>
   <!--      <table class=margin-top cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tbody>
            <tr>
                <td width=380><img height=61 alt=技术部项目开发/修改系统 src="../public/image/logo.gif" width=236 border=0></td>
            </tr>
            </tbody>
        </table> -->
        <table class="margin-top b" id=Nav cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tr><td background="../public/image/nav_bg.gif" width="760px" height="30px"><span style="margin-left:10px">技术部任务管理 > <span id="two">添加任务</span></span></td></tr>
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
                                        <div class="l colorfe5705 b font14">技术部任务单--添加任务</div>
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
                                                        <?php if(empty($pro)){?>
<form method="post" action="../controller/addPro.php">
    <table style="width: 450px;margin:0 35px;">
        <tr>
            <td style="width: 30%;"><span style="float: right">编号：</span></td>
            <td style="width: 20%;"><input type="text" readonly="true" name="number" value="<?php echo createNewNumber()?>"></td>
            <td style="width: 25%;"><span style="float: right">日期：</span></td>
            <td style="width: 25%;"><input type="text" readonly="true" placeholder="<?php echo date('Y-m-d')?>"></td>   
        </tr>
        <tr>
            <td><span style="float: right">部门：</td>
            <td colspan="3">
            <?php if(is_array($depart)){
                foreach ($depart as $value) {
                    echo '<span style="margin-right:15px"><input type="radio" '.(($value["id"]==$userInfo["depart_id"])?"checked":"").' name="departId"  value="'.$value['id'].'">'.$value['depart_name'].'</span>';
                }
            }?>
            </td>
        </tr>
        <tr>
            <td><span style="float: right">任务名称：</span></td>
            <td colspan="3"><input type="text" style="width: 50%" name="proName"></td>
        </tr>
        <tr>
            <td><span style="float: right">任务负责人：</span></td>
            <td colspan="3"><input type="text" style="width: 50%" name="proUsername"></td>
        </tr>
        <tr>
            <td><span style="float: right">预计完成日期：</span></td>
            <td colspan="3">
                <select name="year" class="change" id="year">
                    <?php for($i = date('Y');$i < date('Y')+10;++$i){
                        echo '<option value ="'.$i.'">'.$i.'</option>';
                    }?>
                </select>
                年
                <select name="month" class="change" id="month">
                    <?php for($i = 1;$i < 13;++$i){
                        echo '<option value ="'.$i.'" '.($i == date("m")?"selected":"").'>'.$i.'</option>';
                    }?>
                </select>
                月
                <select name="day" id="day">
                    <?php for($i = 1;$i <= cal_days_in_month(CAL_GREGORIAN, date("m"), date('Y'));++$i){
                        echo '<option value ="'.$i.'" '.($i == date("d")?"selected":"").'>'.$i.'</option>';
                    }?>
                </select>
                日
            </td>
        </tr>
        <tr>
            <td><span style="float: right">任务内容：</span></td>
            <td colspan="4"><textarea name="proContent" cols="50" rows="4"></textarea></td>
        </tr>
        <tr>
            <td><span style="float: right">部门经理：</span></td>
            <td><input type="text" name="departGm"></td>
            <td><span style="float: right">审核：</span></td>
            <td><input type="text" name="checkUsername"></td>
        </tr>
        <tr>
            <td  colspan="4" style="text-align: center"><input type="submit" value=提交> <input type="reset" value=重填></td>
        </tr>
    </table>
</form>
                                                        <!--添加完数据，单纯的展示-->
                                                        <?php }else{?>
<table style="width: 450px;margin:0 35px;">
        <tr>
            <td style="width: 30%;"><span style="float: right">编号：</span></td>
            <td style="width: 20%;"><input type="text" readonly="true" value="<?php echo $pro['number'];?>"></td>
            <td style="width: 25%;"><span style="float: right">日期：</span></td>
            <td style="width: 25%;"><input type="text" readonly="true" placeholder="<?php echo date('Y-m-d')?>"></td>   
        </tr>
        <tr>
            <td><span style="float: right">部门：</td>
            <td colspan="3">
            <?php if(is_array($depart)){
                foreach ($depart as $value) {
                    echo '<span style="margin-right:15px"><input type="radio" '.(($value["id"]==$userInfo["depart_id"])?"checked":"").' name="departId"  value="'.$value['id'].'">'.$value['depart_name'].'</span>';
                      
                }
            }?>
            </td>
        </tr>
        <tr>
            <td><span style="float: right">任务名称：</span></td>
            <td colspan="3"><input type="text" style="width: 50%" readonly="true" value="<?php echo $pro['name'];?>"></td>
        </tr>
        <tr>
            <td><span style="float: right">任务负责人：</span></td>
            <td colspan="3"><input type="text" style="width: 50%" readonly="true" value="<?php echo $pro['username'];?>"></td>
        </tr>
        <tr>
            <td><span style="float: right">预计完成日期：</span></td>
            <td colspan="3">
              <?php echo $pro['end_time']?>
            </td>
        </tr>
        <tr>
            <td><span style="float: right">任务内容：</span></td>
            <td colspan="4"><textarea  cols="50" rows="4" readonly="true"><?php echo $pro['content'];?></textarea></td>
        </tr>
        <tr>
            <td><span style="float: right">部门经理：</span></td>
            <td><input type="text" readonly="true" value="<?php echo $pro['depart_gm'];?>"></td>
            <td><span style="float: right">审核：</span></td>
            <td><input type="text" readonly="true" value="<?php echo $pro['check_username'];?>"></td>
        </tr>
        <tr>
            <td  colspan="4" style="text-align: center"><a href="addPro.php" style="color: red;font-size: 15px"><b>添加成功，继续添加</b></a></td>
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
                $('#menu2').addClass('CurrentSubMenu');

                //根据选择的年月更改可选择的日期
                $("select[class=change]").change(function(){
                    var curMonthDays = new Date($('select[id=year]').val(), ($('select[id=month]').val()), 0).getDate();
                    var html = '';
                    var orgDay = $('select[id=day]').val();
                    for(var i = 1;i <= curMonthDays;++i){
                        html+='<option value ="'+i+'" '+(i == orgDay?"selected":"")+'>'+i+'</option>';
                    }
                    $('#day').html(html);
                    var nowDay = $('select[id=day]').val();
                    //根据原先日期与现在日期，如果不相同（及新的天数少于之前的天数了），则选择最后一个
                    if(orgDay != nowDay){
                        $("select[id=day] option:last").prop("selected",true);
                    }
                });
            });
        </script>
    </body>
</html>
