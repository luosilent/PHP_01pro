<?php
    include '../helper/checkLogin.php';
    $limit = 3;//每页显示的条数
    $page = isset($_GET['page'])?$_GET['page']:1;//页数，默认第一页
    $result = getAllUserInfo($page,$limit);//其中一页的数据
    $count = count(getAllUserInfo());//总条数
    $allPage = ceil($count/$limit);//总页数，向上取整
?>
<!DOCTYPE HTML PUBLIC "-//W3C//Dtd HTML 4.01 Transitional//EN" "http://www.w3c.org/tr/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xHTML">
    <head>
        <title>项目管理系统</title>
        <meta http-equiv=Content-Type content="text/HTML; charset=utf-8">
        <link href="../public/css/pm.css" type=text/css rel=stylesheet>
        <link rel="stylesheet" type="text/css" href="../public/css/nav.css">
            <style type="text/css">
                .myPage{
                    padding-left: 5px;
                    padding-right: 5px;
                }
            </style>
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
            <tr><td background="../public/image/nav_bg.gif" width="760px" height="30px"><span style="margin-left:10px">技术部任务管理 > <span id="two">帐号管理</span></span></td></tr>
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
                                        <div class="l colorfe5705 b font14">技术部任务单--帐号管理</div>
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
    <table style="width: 450px;margin:0 35px;">
        <tr>
            <td>ID</td>
            <td>帐号</td>
            <td>密码</td>
            <td>部门</td>
            <td>角色</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        <?php foreach($result as $user){?>
	<tr>
            <td><?php echo $user['id'];?></td>
            <td><?php echo $user['username'];?></td>
            <td><?php echo $user['password'];?></td>
            <td><?php echo $user['depart_name'];?></td>
            <td><?php switch ($user['role']){
                case 'admin':
                    echo '管理员';
                    break;
                default :
                    echo '-/-';
                    break;
            };?></td>
            <td><?php echo $user['time'];?></td>
            <td><?php switch ($user['role']){
                case 'admin':
                    echo '-/-';
                    break;
                default :
                    echo '<a value="'.$user['id'].'" class="delete" href="#">删除</a>';
                    break;
            };?>
                </td>
        </tr>
        <?php }?>
        <tr>
            <td colspan="8">
                <div  style="margin: 10px 0;text-align: center;font-size: 15px;<?php echo $allPage<=1?'display:none':""?>" id="myPage" >共<?php echo $count;?>条
                    <a href="account.php?page=1" class="firstPage">首页</a>
                    <a href="account.php?page=<?php echo $page-1?>" class="firstPage">上一页</a>
                    <?php ($page==2)?$i=1:($page>2?$i=2:$i=0);
                        for($i;$i>0;--$i){
                            echo '<a href="account.php?page='.($page-$i).'" class="myPage">'.($page-$i).'</a>';
                        }
                    ?>
                    <a href="javascript:void(0);" style="opacity: 0.5"><?php echo $page?></a>
                    <?php (($allPage-$page)==1)?$j=1:(($allPage-$page)>1?$j=2:$j=0);
                        for($k=1;$k<=$j;++$k){
                            echo '<a href="account.php?page='.($page+$k).'" class="myPage">'.($page+$k).'</a>';
                        }
                    ?>
                    <a href="account.php?page=<?php echo $page+1?>" class="endPage">下一页</a>
                    <a href="account.php?page=<?php echo $allPage?>" class="endPage">末页</a>
                    <?php echo '共'.$allPage.'页 第'.$page.'页';?></div>
            </td>
        </tr>
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
                $('#menu5').addClass('CurrentSubMenu');
                if(<?php echo ($page <=1 )?1:0;?>){
                    $('.firstPage').attr('href','javascript:void(0);');
                    $('.firstPage').css('opacity','0.5');
                }
                if(<?php echo ($page >= $allPage )?1:0;?>){
                    $('.endPage').attr('href','javascript:void(0);');
                    $('.endPage').css('opacity','0.5');
                }
                
                
                $('.delete').click(function(){
                    if(confirm('是否删除该用户？')){
                        var id = $(this).attr('value');
                        $.ajax({  
                            url:'../controller/deleteUser.php',  
                            type:"post", 
                            data:{'id':id},  
                            dataType:"json",
                            error:function(){console.log("ajax请求错误！");},  
                            success:function(result){
                                alert('删除用户成功');
                                location.reload();
                            }  
                        });
                    }
                })
  
            });
        </script>
    </body>
</html>
