<?php
    include '../helper/checkLogin.php';
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
<form method="post" action="queryProInfo.php">
    <table style="width: 450px;margin:0 35px;">
        <tr>
            <td style="width:20%;">
                查询方式：
            </td>
            <td style="width:80%;">
                <span>
                    <select name="condition">
                        <option value ="startTime">开始时间</option>
                        <option value ="endTime">结束时间</option>
                    </select>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                查询条件：
            </td>
            <td>
                <span>
                    <select name="method">
                        <option value ="specific">具体时间</option>
                        <option value ="scope">时间范围</option>
                    </select>
                </span>
            </td>
        </tr>
        <tr id="specific">
            <td>具体时间：</td>
            <td>
                <span class="specificYear">
                    <select name="specificYear" class="change3" id="specificYear">
                        <?php for($i = date('Y')-10;$i < date('Y')+10;++$i){
                            echo '<option value ="'.$i.'"'.(($i==date('Y'))?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>年
                </span>
                <span class="specificMonth">
                    <select name="specificMonth" class="change3" id="specificMonth">
                        <option value =""></option>
                        <?php for($i = 1;$i < 13;++$i){
                            echo '<option value ="'.$i.'" '.($i == date("m")?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>月
                </span>
                <span class="specificDay">
                    <select name="specificDay" id="specificDay">
                        <option value =""></option>
                        <?php for($i = 1;$i <= cal_days_in_month(CAL_GREGORIAN, date("m"), date('Y'));++$i){
                            echo '<option value ="'.$i.'" '.($i == date("d")?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>日
                </span>
                <input type="hidden" value="day" name="specificType" id="specificType">
            </td>
        </tr>
        <tr id="start" style="display:none;">
            <td>开始时间：</td>
            <td>
                <span class="startYear">
                    <select name="startYear" class="change1" id="startYear">
                        <option value =""></option>
                        <?php for($i = date('Y')-10;$i < date('Y')+10;++$i){
                            echo '<option value ="'.$i.'"'.(($i==date('Y'))?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>年
                </span>
                <span class="startMonth">
                    <select name="startMonth" class="change1" id="startMonth">
                        <?php for($i = 1;$i < 13;++$i){
                            echo '<option value ="'.$i.'" '.($i == date("m")?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>月
                </span>
                <span class="startDay">
                    <select name="startDay" id="startDay">
                        <?php for($i = 1;$i <= cal_days_in_month(CAL_GREGORIAN, date("m"), date('Y'));++$i){
                            echo '<option value ="'.$i.'" '.($i == date("d")?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>日
                </span>
            </td>
        </tr>
        <tr id="end" style="display: none;">
            <td>结束时间：</td>
            <td>
                <span class="endYear">
                    <select name="endYear" class="change2" id="endYear">
                        <option value =""></option>
                        <?php for($i = date('Y')-10;$i < date('Y')+10;++$i){
                            echo '<option value ="'.$i.'"'.(($i==date('Y'))?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>年
                </span>
                <span class="endMonth">
                    <select name="endMonth" class="change2" id="endMonth">
                        <?php for($i = 1;$i < 13;++$i){
                            echo '<option value ="'.$i.'" '.($i == date("m")?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>月
                </span>
                <span class="endDay">
                    <select name="endDay" id="endDay">
                        <?php for($i = 1;$i <= cal_days_in_month(CAL_GREGORIAN, date("m"), date('Y'));++$i){
                            echo '<option value ="'.$i.'" '.($i == date("d")?"selected":"").'>'.$i.'</option>';
                        }?>
                    </select>日
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;width: 100%">
                <input type="submit" value="查询">
            </td>
        </tr>
    </table>
</form>
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
                
                $("select[name=method]").change(function(){
                    if($("select[name=method]").val() == 'specific'){//具体时间
                        $('#start').hide();
                        $('#end').hide();
                        $('#specific').show();
                    }else if($("select[name=method]").val() == 'scope'){//时间范围
                        $('#specific').hide();
                        $('#start').show();
                        $('#end').show();
                    }
                })
                
                $("select[class=change3]").change(function(){
                    var html = '<option value =""></option>';
                    if($('select[id=specificYear]').val()){//具体年份有值
                        $('#specificType').val('year');
                        $('.specificMonth').show();
                        if($('select[id=specificMonth]').val()){//具体月份有值
                            $('#specificType').val('month');
                            $('.specificDay').show();
                            var orgDay = $('select[id=specificDay]').val();
                            var curMonthDays = new Date($('select[id=specificYear]').val(), ($('select[id=specificMonth]').val()), 0).getDate();
                            for(var i = 1;i <= curMonthDays;++i){
                                html+='<option value ="'+i+'" '+(i == orgDay?"selected":"")+'>'+i+'</option>';
                            }
                            $('#specificDay').html(html);
                            var nowDay = $('select[id=specificDay]').val();
                            //根据原先日期与现在日期，如果不相同（及新的天数少于之前的天数了），则选择最后一个
                            if(orgDay != nowDay){
                                $("select[id=specificDay] option:last").prop("selected",true);
                            }
                            if($('select[id=specificDay]').val()){
                                $('#specificType').val('day');
                            }else{
                                $('#specificType').val('month');
                            }
                        }else{
                            $('.specificDay').hide();
                        }
                    }else{//具体年份没有值
                        $('#specificType').val('null');
                        $('.specificMonth').hide();
                        $('.specificDay').hide();
                    }
                });
                $("select[id=specificDay]").change(function(){
                    if($('select[id=specificDay]').val()){
                        $('#specificType').val('day');
                    }else{
                        $('#specificType').val('month');
                    }
                })
                
                
                //开始时间
                $("select[class=change1]").change(function(){
                    var html = '';
                    var orgDay = $('select[id=startDay]').val();
                    var curMonthDays = new Date($('select[id=startYear]').val(), ($('select[id=startMonth]').val()), 0).getDate();
                    for(var i = 1;i <= curMonthDays;++i){
                        html+='<option value ="'+i+'" '+(i == orgDay?"selected":"")+'>'+i+'</option>';
                    }
                    $('#startDay').html(html);
                    var nowDay = $('select[id=startDay]').val();
                    //根据原先日期与现在日期，如果不相同（及新的天数少于之前的天数了），则选择最后一个
                    if(orgDay != nowDay){
                        $("select[id=startDay] option:last").prop("selected",true);
                    }
                    if($('select[id=startYear]').val()){
                        $('.startMonth').show();
                        $('.startDay').show()
                    }else{
                        $('.startMonth').hide();
                        $('.startDay').hide()
                    }
                });
                
                //结束时间
                $("select[class=change2]").change(function(){
                    var html = '';
                    var orgDay = $('select[id=endDay]').val();
                    var curMonthDays = new Date($('select[id=endYear]').val(), ($('select[id=endMonth]').val()), 0).getDate();
                    for(var i = 1;i <= curMonthDays;++i){
                        html+='<option value ="'+i+'" '+(i == orgDay?"selected":"")+'>'+i+'</option>';
                    }
                    $('#endDay').html(html);
                    var nowDay = $('select[id=endDay]').val();
                    //根据原先日期与现在日期，如果不相同（及新的天数少于之前的天数了），则选择最后一个
                    if(orgDay != nowDay){
                        $("select[id=endDay] option:last").prop("selected",true);
                    }
                    if($('select[id=endYear]').val()){
                        $('.endMonth').show();
                        $('.endDay').show()
                    }else{
                        $('.endMonth').hide();
                        $('.endDay').hide()
                    }
                });
  
            });
        </script>
    </body>
</html>
