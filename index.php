<?php
    include("helper/mysql.php");
    $pro_rem = '';  
    $type = isset($_GET['type']) ? $_GET['type'] : false;  
    $pro_name = isset($_COOKIE['pro_name']) ? $_COOKIE['pro_name'] : '';       
    $pro_pass = isset($_COOKIE['pro_pass']) ? $_COOKIE['pro_pass'] : '';
    if (!empty($pro_name) && !empty($pro_pass)) {
        $pro_rem = true;   
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>技术部任务系统</title>
        <style type="text/css">
            .register{
                display: none;
            }
        </style>
    </head>
    <body>
        <table align="center">
            <tr><td><img src="public/image/logos.jpg" width="236px" height="61px"></td></tr>
            <!--导航栏-->
            <tr><td background="public/image/nav_bg.gif" width="760px" height="30px"><span style="margin-left:10px">综合管理系统 > <span id="two">登录界面</span></span></td></tr>
        </table>
        <form action="controller/login.php" method="post" name="ind">
            <table align="center">
                <tr><td width="380px" height="200px"><img src="public/image/rightpics.jpg"></td>
                    <td width="350px" height="200px">
                        <table>
                            <tr class="register">
                                <td colspan="2" style="text-align: center;font-size: 25px;font-weight: bold">注册信息</td>
                            </tr>
                            <tr>
                                <td>帐号： </td>
                                <td><input type="text" name="username" size="20" value="<?php echo $pro_name;?>" /></td>
                            </tr>
                            <tr>
                                <td>密码： </td>
                                <td><input type="password" name="password" size="20" value="<?php echo $pro_pass;?>" /></td>
                            </tr>
                            <tr class="register">
                                <td>确认密码： </td>
                                <td><input type="password" name="password2" size="20" value="" /></td>
                            </tr>
                            <tr class="register">
                                <td>所属部门： </td>
                                <td>
                                    <select name="depart_id" style="width:153px;height: 22px" id='depart'>
                                        <option value="">选择部门</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span style="font-size: 15px;" class='login'>记住我<input type="checkbox" name="remember" <?php if ($pro_rem) echo 'checked="checked"'; ?>/></span>
                                    <a class='register' href='javascript:void(0)' id='login' style="font-size:12px;margin-left: 60px;">登陆</a>
                                    <input type="submit" value="登陆" style="float:right"/>
                                </td>
                            </tr>
                            <tr class="login">
                                <td align="right" colspan="2">
                                    <a style="font-size: 12px" id='register' href="javascript:void(0)">注册</a>
                                </td>
                            </tr>
                            <input type="hidden" value="login" name='type'/>
                        </table>
                    </td>
                 </tr>
            </table>
        </form>
        <table class=margin-top cellSpacing=0 cellPadding=0 width=760 align=center border=0>
            <tbody>
                <tr>
                    <td align=middle background="public/image/down.gif" height=94> ◎版权所有 </td>
                </tr>
            </tbody>
        </table>
        <script src="public/js/jquery-2.1.1.min.js"></script>
        <script>
            $(document).ready(function(){
                //记录是否已经查过数据
                var depart = "";
                //登录时，点击注册按钮
                $('#register').click(function(){
                    if(!depart){
                        <?php $depart = getAllDepart();?>
                        var html = '<?php if(is_array($depart)){
                            foreach ($depart as $value) {
                                echo '<option value="'.$value['id'].'">'.$value['depart_name'].'</option>;';
                            }
                        }?>';
                        depart = 1;
                    }
                    $('#depart').append(html);
                    $('input').val("");
                    $('.login').hide();
                    $('input[type=submit]').val("注册");
                    $('input[type=hidden]').val("register");
                    $('#two').html("注册界面");
                    $('.register').show();
                })
                //注册时，点击登录按钮
                $('#login').click(function(){
                    $('input').val("");
                    $('.register').hide();
                    $('input[name=username]').val("<?php echo $pro_name?>");
                    $('input[name=password]').val("<?php echo $pro_pass?>");
                    $('input[type=submit]').val("登录");
                    $('input[type=hidden]').val("login");
                    $('#two').html("登录界面");
                    $('.login').show();
                })
                
                if("<?php echo $type?>"){
                    $('#register').click();
                }
            });
        </script>
    </body>
</html>