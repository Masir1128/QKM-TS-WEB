<?php
require '../function.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../layui/css/layui.css">
	<script type="text/javascript" src="../layui/layui.js"></script>
  <style type="text/css">
  .layui-form button{margin-left: 30px;}
  </style>
</head>
<body>

<!-- <form class="layui-form" action="del.php" method="post">
  <input name="a" type="hidden" id="a" value="a"/>
  <button name="dell" id="submit" type="submit" class="layui-btn layui-btn-radius  layui-btn-danger">删除</button>
  <button name="cal" id="submit" type="submit" class="layui-btn layui-btn-radius  layui-btn-danger">取消</button>
    
</form> -->

<!-- 该部分代码是用来获取新增信息，并写入数据库
-----开发时间：2020/06/06
-----遗留问题：还未实现判断，自动不要写入数据库
-----开发者：Masir
 -->
<?php 
// 定义Html传过来的信息

  //for test
    

delete($_GET["tableName"],$db,$_GET["index"]);//调用函数delete，传入表名和被删除行索引



/*$stt5 = delete('tb_message',$db,'id=1');
print_r($stt5);
*/

?>

<!-- <script>
//Demo
layui.use('form', function(){
  var form = layui.form;
  
});
</script> -->
</body>
</html>