<?php
require_once 'mysql.php';
header("content-type:text/html;charset=utf-8");  
error_reporting(0);
//弹出提示，默认跳到订餐页面，根据第二个参数判断具体跳到哪一页
function notice_href($notice,$page = '../view/dinner.php'){

    echo '<script charset="utf-8" type="text/javascript" >';
    echo "alert('".$notice."');";
    echo ($page == 'dinner.php') ? 'window.location="dinner.php"': 'window.location="../view/dinner.php"';
    echo '</script>';
    exit;

}
//判断当前时间是否可订餐
function time_validate($start = '09:00:00',$end = '19:30:00'){
    $start = strtotime(date('Y-m-d') . $start);
    $end = strtotime(date('Y-m-d') . $end);
    $now = time();
    if ($now > $start && $now < $end) {
        return true;
    }
    return false;
}

//根据sql语句获取结果数据
function get_result($sql){
    global $pdo;
    $sth = $pdo->prepare($sql);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);
}
//判断用户名密码是否正确，正确返回id
function check_user_info($username ,$password)
{
    global $pdo;
    $sql = "SELECT id FROM luo_prousers WHERE username='{$username}' AND password='{$password}'";
    $sth = get_result($sql);
    return $sth['id'];

}


//判断用户是否已经订餐
function check_user_record($uid){
    global $pdo;
    $start = date('Y-m-d');
    $end = date("Y-m-d",strtotime("+1 day"));
    $sql = "SELECT id FROM luo_record WHERE uid='{$uid}' AND create_time BETWEEN '{$start}' AND '{$end}'";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $sth->fetchall(PDO::FETCH_ASSOC);
    $number_of_rows = $sth->rowCount();
    if($number_of_rows >= 1){
        return true;
    }
    return false;
}

//添加一条订餐数据
function add_record($uid){
    global $pdo;
    $time = date('Y-m-d H:i:s');
    $sql = "INSERT INTO luo_record (uid,create_time) VALUES ('{$uid}','{$time}')";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $number_of_rows = $sth->rowCount();
    if (1 == $number_of_rows){
        return true;
    }
    return false;
}

//删除一条订餐数据
function cancle_record($uid){
    global $pdo;
    $start = date('Y-m-d');
    $end = date("Y-m-d",strtotime("+1 day"));
    $sql = "DELETE FROM luo_record WHERE uid='{$uid}' AND create_time BETWEEN '{$start}' AND '{$end}'";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $number_of_rows = $sth->rowCount();
    if (1 == $number_of_rows){
        return true;
    }
    return false;
}

//当日所有订餐人的数据
function get_records(){
    global $pdo;
    $start = date('Y-m-d');
    $end = date("Y-m-d",strtotime("+1 day"));
    $arr = array();
    //$sql = "select uid,create_time FROM luo_record WHERE create_time BETWEEN '{$start}' AND '{$end}'";
    $sql = "SELECT u.username,d.depart_name,r.create_time AS time 
						FROM luo_prodepart d, luo_record r, luo_prousers u
						WHERE u.id = r.uid AND u.depart_id = d.id AND r.create_time BETWEEN '{$start}' AND '{$end}'
						ORDER BY time ASC ";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $arr[] = $row;
    }

    return $arr;//所有今日订餐的一个二维数组

}

//把上面获取到的订餐人的数据按部分变成一个二维数组
function filter_records($records){
    $arr = array();
    foreach($records as $key => $user){
        $arr[$user['depart_name']][$key]['username'] = $user['username'];
        $arr[$user['depart_name']][$key]['time'] = substr($user['time'],11,8);
    }
    return $arr;
}


//获取所有的部门列表
function getAllDepart(){
    global $pdo;
    $sql = 'SELECT * FROM luo_prodepart';
    $sth = $pdo->prepare($sql);
    $sth->execute();
    return $sth->fetchall(PDO::FETCH_ASSOC);
}

//判断用户是否存在，并获取其权限
function checkUserExists($name,$pwd){
    global $pdo;
    $sql = 'SELECT * FROM luo_prousers WHERE username = ? AND password = ?';
    $sth = $pdo->prepare($sql);
    $sth->execute(array("{$name}","{$pwd}"));
    return $sth->fetch(PDO::FETCH_ASSOC);
}

//判断用户名是否已经使用
function checkUsernameExists($name){
    global $pdo;
    $sql = 'SELECT * FROM luo_prousers WHERE username = ? ';
    $sth = $pdo->prepare($sql);
    $sth->execute(array("{$name}"));
    return $sth->fetch(PDO::FETCH_ASSOC);
}

//添加用户信息到数据量
function insertUserInfo($name,$pass,$depart){
    global $pdo;
    $sql = 'INSERT INTO luo_prousers (username,password,depart_id,create_time) VALUES (?,?,?,?)';
    $create_time = date('Y-m-d H:i:s');
    $sth = $pdo->prepare($sql);
    $sth->execute(array("{$name}","{$pass}","{$depart}", "$create_time"));
    return $pdo->lastInsertId();
}

//获取所有用户信息
function getAllUserInfo($page = '',$limit = 10){
    global $pdo;
    $start = ($page-1)*$limit;
    $sql = "SELECT u.id,u.username,u.password,d.depart_name,u.role,u.create_time AS time 
            FROM luo_prousers u, luo_prodepart d 
            WHERE u.depart_id = d.id 
            ORDER BY u.id DESC ";
    if($page){
        $sql.="LIMIT {$start},{$limit}";
    }
    $sth = $pdo->prepare($sql);
    $sth->execute();
    return $sth->fetchall(PDO::FETCH_ASSOC);
}

//根据id删除用户
function deleteUserById($id){
    global $pdo;
    $sql = "DELETE FROM luo_prousers WHERE id = ?";
    $sth = $pdo->prepare($sql);
    $sth->execute(array("{$id}"));
    return $sth->rowCount();
}
    
//设置cookie值，默认时间3600*24 一天
function setCookieInfo($name,$value,$time = 3600000,$path = '/'){
    setcookie($name, $value, time() + $time,$path);
}

//删除cookie值
function deleteCookieInfo($name,$value = '',$time = -1,$path = '/'){
    setcookie($name, $value, time() + $time,$path);
}

//提示并跳转
function notice($notice,$page = NULL){
    echo '<script type="text/javascript">';
    if($notice){
        echo "alert('".$notice."');";
    }
    //根据输入的$page跳转，默认跳回上一页
    echo $page?'window.location="'.$page.'";':'window.location="'.$_SERVER['HTTP_REFERER'].'";';
    echo '</script>';
    exit;
}

function createNewNumber(){
    $year_code = array('A','B','C','D','E','F','G','H','I','J');
    return $year_code[intval(date('Y'))-2017].strtoupper(dechex(date('m'))).date('d').substr(time(),-5).substr(microtime(),2,5).rand(10,99);
}


//新建一个任务
function addPro($number,$departId,$proName,$proUsername,$endTime,$proContent,$departGm,$checkUsername,$uid){
    global $pdo;
    $time = date('Y-m-d');
    $now = date('Y-m-d H:i:s');
    $sql = 'INSERT INTO luo_project (uid,number,date,depart_id,name,username,end_time,content,depart_gm,check_username,create_time) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
    $sth = $pdo->prepare($sql);
    $sth->execute(array("{$uid}","{$number}","{$time}","{$departId}","{$proName}","{$proUsername}","{$endTime}","{$proContent}","{$departGm}","{$checkUsername}","{$now}"));
    return $pdo->lastInsertId();
}

//通过id获取任务数据
function getProById($id){
    if(!$id){
        return '';
    }
    global $pdo;
    $sql = 'SELECT p.*,d.depart_name AS depart 
            FROM luo_project p,luo_prodepart d 
            WHERE p.depart_id = d.id AND p.id = ?';
    $sth = $pdo->prepare($sql);
    $sth->execute(array("{$id}"));
    return $sth->fetch(PDO::FETCH_ASSOC);
}

//处理时间格式，默认为day类型
function timeFormat($year,$month,$day,$type ='day'){
    $time = '';
    switch ($type){
        case 'null':
            break;
        case 'year':
            $time = $year.'-01-01 ';
            break;
        case 'month':
            $time = $year.'-'.($month<10?('0'.$month):$month).'-01';
            break;
        case 'day':
            if(!$year){
                break;
            }
            $time = $year.'-'.($month<10?('0'.$month):$month).'-'.($day<10?('0'.$day):$day);
            break;
        default :
            notice("时间类型错误！");
    }
    return $time;
}

//通过一个具体时间查询任务
//具体时间，具体时间的类型（年，月，日），查询条件（开始时间还是结束时间）
function queryProBySpecificTime($time,$timeType,$type){
    global $pdo;
    switch ($timeType){
        case 'year':
            $endTime = date("Y-m-d", strtotime("+1 year -1 day", strtotime($time)));//当年最后一天
            $sql = "SELECT p.*,d.depart_name AS depart 
                FROM luo_project p,luo_prodepart d 
                WHERE p.depart_id = d.id AND {$type} BETWEEN ? AND ?";
            $sth = $pdo->prepare($sql);
            $sth->execute(array("{$time}","{$endTime}"));
            break;
        case 'month':
            $endTime = date("Y-m-d", strtotime("+1 months -1 day", strtotime($time)));
            $sql = "SELECT p.*,d.depart_name AS depart 
                FROM luo_project p,luo_prodepart d 
                WHERE p.depart_id = d.id AND {$type} BETWEEN ? AND ?";
            $sth = $pdo->prepare($sql);
            $sth->execute(array("{$time}","{$endTime}"));
            break;
        case 'day':
            $sql = "SELECT p.*,d.depart_name AS depart 
                FROM luo_project p,luo_prodepart d 
                WHERE p.depart_id = d.id AND {$type} = ?";
            $sth = $pdo->prepare($sql);
            $sth->execute(array("{$time}"));
            break;
        default :
            notice("查询时间类型错误！");
    }
    return $sth->fetchall(PDO::FETCH_ASSOC);
}


//根据时间查询任务
function queryProByScopeTime($startTime,$endTime,$type){
    global $pdo;
    if($startTime && $endTime){//有开始时间，结束时间
        $sql = "SELECT p.*,d.depart_name AS depart 
                FROM luo_project p,luo_prodepart d 
                WHERE p.depart_id = d.id AND {$type} BETWEEN ? AND ?";
        $sth = $pdo->prepare($sql);
        $sth->execute(array("{$startTime}","{$endTime}"));
    }else if($startTime){//只有开始时间
        $sql = "SELECT p.*,d.depart_name AS depart 
                FROM luo_project p,luo_prodepart d
                WHERE p.depart_id = d.id AND {$type} >= ?";
        $sth = $pdo->prepare($sql);
        $sth->execute(array("{$startTime}"));
    }else if($endTime){//只有结束时间
        $sql = "SELECT p.*,d.depart_name AS depart 
                FROM luo_project p,luo_prodepart d
                WHERE p.depart_id = d.id AND {$type} <= ?";
        $sth = $pdo->prepare($sql);
        $sth->execute(array("{$endTime}"));
    }else{//其实这边就是所有的任务
        $sql = "SELECT p.*,d.depart_name AS depart 
                FROM luo_project p,luo_prodepart d
                WHERE p.depart_id = d.id";
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }
    return $sth->fetchall(PDO::FETCH_ASSOC);
}


//根据时间查询任务
function getAllPro($page='',$limit = 10){
    global $pdo;
    $start = ($page-1)*$limit;
    $sql = "SELECT p.*,d.depart_name AS depart 
            FROM luo_project p,luo_prodepart d
            WHERE p.depart_id = d.id 
            ORDER BY id DESC ";
    if($page){
        $sql.="LIMIT {$start},{$limit}";
    }
    $sth = $pdo->prepare($sql);
    $sth->execute();
    return $sth->fetchall(PDO::FETCH_ASSOC);
}

//根据id删除任务
function deleteProById($id){
    global $pdo;
    $sql = "DELETE FROM luo_project WHERE id = ?";
    $sth = $pdo->prepare($sql);
    $sth->execute(array("{$id}"));
    return $sth->rowCount();
}

