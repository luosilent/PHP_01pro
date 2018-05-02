<table id='__01' cellSpacing=0 cellPadding=0 style="height: 161px;width: 195px;border: 0;">
    <tbody>
        <tr>
            <td style="width: 195px;height: 35px"><img src="../public/image/manage_01.gif" style="width: 195px;height: 35px"></td>
        </tr>
        <tr>
            <td background="../public/image/manage_02.gif" style="text-align: top;height: 103px">
                <div id=Manage>
                    <div class='SubMenu' id="menu1"><a href="index.php">后台首页</a></div>
                    <div class='SubMenu' id="menu2"><a href="addPro.php">添加任务</a></div>
                    <div class='SubMenu' id="menu3"><a href="queryPro.php">任务查询</a></div>
                    <div class='SubMenu' id="menu4"><a href="proStatistics.php">任务统计</a></div>
                    <?php if($userInfo['role'] == 'admin'){?>
                    <div class='SubMenu' id="menu5"><a href="account.php">帐号管理</a></div>
                    <?php }?>
                    <div class='SubMenu' id="menu6"><a onclick="return confirm('确定退出吗?')" href="../controller/login.php?out=yes">退出系统</a></div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="height: 23px"><img src="../public/image/manage_03.gif" style="height: 23px;width: 195px"></td>
        </tr>
    </tbody>
</table>
