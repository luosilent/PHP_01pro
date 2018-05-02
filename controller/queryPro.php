<?php
//查询条件，与表中的字段对应
switch ($_POST['condition']){
    case 'startTime':
        $type = 'date';
        break;
    case 'endTime':
        $type = 'end_time';
        break;
    default :
        notice("查询条件错误！");
}
switch ($_POST['method']){//查询方法
    case 'specific'://具体时间
        $specificTime = timeFormat($_POST['specificYear'], $_POST['specificMonth'], $_POST['specificDay'],$_POST['specificType']);
        $result = queryProBySpecificTime($specificTime, $_POST['specificType'] ,$type);
        break;
    case 'scope'://日期范围
        $startTime = timeFormat( $_POST['startYear'], $_POST['startMonth'], $_POST['startDay']);
        $endTime = timeFormat( $_POST['endYear'], $_POST['endMonth'], $_POST['endDay']);
        if($startTime && $endTime && $startTime>$endTime){
            notice("开始时间不能晚于结束时间！");
        }
        $result = queryProByScopeTime($startTime, $endTime ,$type);
        break;
    default :
        notice("查询方法类型错误！");
}

if($result === FALSE){
    notice("查询失败，请重新再试！");
}

