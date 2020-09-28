
<?php

// 说明：该模块是数据库函数接口；
// 开始时间：7/22/2020
// 开发人：Masir
// 版本：测试版V1.1
// 历史版本：

header('Content-type:text/html;charset=utf-8');

// 设置数据库连接参数
$db = array(
    'db_host' => '127.0.0.1',
    'db_user' => 'root',
    'db_pass' => 'qkmuser',
    'db_name' => 'grade'
);

// 建立数据库连接
function db_connect($db)
{
    // 创建连接
    $conn = mysqli_connect($db['db_host'], $db['db_user'], $db['db_pass'],$db['db_name']);

    // 检测连接
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
    	//echo '<h2>连接成功</h2>';
    }
    //设置客户端字符集
    mysqli_set_charset($conn,'utf8');
    return $conn;

    
}


function select($table,$db,$where,$order,$limit=0)
{

    $conn = db_connect($db);

    // 'SELECT * FROM forum_bbs WHERE uid=1 ORDER BY bbs_id DESC'
    $sql = 'SELECT * FROM '.$table.' '.$where.' '.$order;
    // echo $sql;
    if($limit){
        // 连接上一个语句
        $sql .= ' limit '.$limit;
    }
    $rows = [];
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);
    return $rows;
}

/*

描述: 查询数据库，返回一条数据

输入: table      数据库对应的表名
      db         数据库连接的函数函数返回值
      where_k    字段
      where_v    数值

输出: 查询到的项目
*/
function find($table,$db,$where_k,$where_v)
{
    $conn = db_connect($db);
    $sql = 'SELECT * FROM '.$table.' WHERE '.$where_k.'="'.$where_v.'" LIMIT 1'; //LIMIT =1 表示只需要查询一条
    echo $sql;
    $rows=[];
    if ($result = mysqli_query($conn, $sql)) {
        $rows = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $rows;

}

/*

描述: 查询数据库，返回一行信息，用于判断登陆信息

输入: table      数据库对应的表名
      db         数据库连接的函数函数返回值
      where      条件，比如你可以选择某个字段满足哪个条件来获取另一个字段的结果
      field      限制

使用：本项目应用位置有：根据某个1 2 3 4 来查询这个类下面的具体内容

输出: 查询到的项目
*/
function findlogin($table,$db,$where){
    $conn = db_connect($db);
    $rows=[];
    $sql = 'SELECT * FROM '.$table.' WHERE '.$where.' ';
    //print_r($sql);
    $result = mysqli_query($conn,$sql);
    if ($result && mysqli_num_rows($result) >0) {
        $rows[]= mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
        return $rows;
       
}

function findA($table,$db,$where){
    $conn = db_connect($db);
    $rows=[];
    $sql = 'SELECT * FROM '.$table.' WHERE '.$where.' ';
    $result = mysqli_query($conn,$sql);
    if ($result && mysqli_num_rows($result) >0) {
        $rows[]= mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
   
        return $rows;
       
}

//查询数据库，返回单个值
function find_one($table,$db,$where,$field)
{
    $conn = db_connect($db);
    $sql  = 'SELECT ' .$field. ' FROM '.$table.' WHERE '.$where.' LIMIT 1';
    echo $sql;
    $rows = '';
    if ($result = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $rows = $row[$field];
        mysqli_free_result($result);
    }
    mysqli_close($conn);
    return $rows;
}

/*

描述: 查询数据库，返回多个值

输入: table      数据库对应的表名
      db         数据库连接的函数函数返回值
      where      条件，比如你可以选择某个字段满足哪个条件来获取另一个字段的结果
      field      限制

使用：本项目应用位置有：根据某个1 2 3 4 来查询这个类下面的具体内容

输出: 查询到的项目
*/
function find_one_all($table,$db,$where,$field)
{
    $conn = db_connect($db);
    $sql  = 'SELECT ' .$field. ' FROM '.$table.' WHERE '.$where.' LIMIT 100';
    //echo $sql;
    //获取结果集
    $result = mysqli_query($conn,$sql);
    $rows=[];
    if ($result && mysqli_num_rows($result) >0) {

        $rows[]= mysqli_fetch_all($result,MYSQLI_ASSOC);

        }
    mysqli_close($conn);
    return $rows;
}


//查询数据库，返回某个ID 的一行信息
function find_ID_name($table,$db,$where)
{
    $conn = db_connect($db);
    $sql  = 'SELECT * FROM ' . $table .' WHERE '.$where;
    //echo $sql;
    //echo '<br/>';
    //获取结果集
    $result = mysqli_query($conn,$sql);
    $rows=[];
    if ($result && mysqli_num_rows($result) >0) {

        $rows[]= mysqli_fetch_all($result,MYSQLI_ASSOC);

        }
    mysqli_close($conn);
    return $rows;
}


//查询数据库，返回所有字段
function find_ID_All($table,$db)
{
    $conn = db_connect($db);
    $sql  = 'SELECT * FROM ' . $table;
    //echo $sql;
    //echo '<br/>';
    //获取结果集
    $result = mysqli_query($conn,$sql);
    $rows=[];
    if ($result && mysqli_num_rows($result) >0) {

        $rows[]= mysqli_fetch_all($result,MYSQLI_ASSOC);

        }
    mysqli_close($conn);
    return $rows;
}

//统计数量
function count_number($table,$db,$where){
    $conn = db_connect($db);

    $sql  = 'SELECT count(*) as count_number FROM '.$table.' WHERE '.$where;
    echo $sql; 
    $rows = '';
    if ($result = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $rows = $row['count_number'];
        mysqli_free_result($result);
    }
    mysqli_close($conn);
    return $rows;
}

//插入数据，返回插入ID
function insert($db,$sql){
    $conn   = db_connect($db);
    $result = mysqli_query($conn,$sql);
    //执行插入操作
    if ($result){
        //只有插入成功后才可以获取新增主键id
        $insert_id = mysqli_insert_id($conn);
    }
    mysqli_close($conn);
    return $insert_id;
}
//修改数据，返回true和false
function save($table,$db,$value,$where){
    $conn = db_connect($db);
    $sql  = 'UPDATE '.$table.' SET '.$value.' WHERE '.$where;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
//删除数据，返回true和false
function delete($table,$db,$where=''){
    $conn = db_connect($db);
    $sql  = 'DELETE FROM '.$table.' WHERE '.$where;
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}