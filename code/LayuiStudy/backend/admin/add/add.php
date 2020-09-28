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
</head>
<body>
<br>
<form class="layui-form" action="" method="post" style="padding-right: 25px">

  <div class="layui-form-item">
    <label class="layui-form-label">姓名</label>
    <div class="layui-input-inline">
      <input type="text" name="name" id="name" class="layui-input" autocomplete="off" placeholder="请输入姓名" >
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">工号</label>
    <div class="layui-input-inline">
      <input type="text" name="gonghao"  id="gonghao" class="layui-input" autocomplete="off" placeholder="请输入工号" >
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">职位</label>
    <div class="layui-input-inline">
      <input type="text" name="zhiwei" id="zhiwei" class="layui-input" autocomplete="off" placeholder="请输入职位" >
    </div>
   </div>

    <div class="layui-form-item">
    <label class="layui-form-label">部门</label>
    <div class="layui-input-inline">
      <select name="bumen" id="bumen" lay-verify="required">
        <option value="技术支持部">技术支持部</option>
        <option value="市场部">市场部</option>
        <option value="其它">其它</option>
      </select>
    </div>
  </div>



<div>
  <button name="submit" id="submit" type="submit" class="layui-btn" style="margin-left:33%;">添加</button>
  <button name="submit"  type="button" class="layui-btn" onclick="parent.layer.closeAll()">取消</button>
</div>
      
</form>

<!-- 该部分代码是用来获取新增信息，并写入数据库
-----开发时间：2020/06/06
-----遗留问题：还未实现判断，自动不要写入数据库
-----开发者：Masir
 -->


<?php


/*echo($name); 
echo "<br>";
echo($gonghao);
echo "<br>";
echo($zhiwei);
echo "<br>";
echo($bumen);*/

  if (isset($_POST['submit'])) {
    $name=$_POST['name'];
    $gonghao=$_POST['gonghao'];
    $zhiwei=$_POST['zhiwei'];
    $bumen=$_POST['bumen'];
    if ($name == "" ||  $gonghao == ""  || $zhiwei == "" ||  $bumen == ""  ){
    // 通过弹框式显示
    echo "<script>parent.layer.alert('请输入完整数据！');</script>";
    }else{
      $check = findlogin('personal_msg',$db,'name="'.$name.'" and Job_Num='.$gonghao);//调用函数findlogin搜索数据库
        if (!empty($check)) {//检验输入的姓名和工号是否与数据库里的记录有重复
          echo "<script>parent.layer.alert('已存在该人员信息！');</script>";
        }
        else{
          $sql = "INSERT INTO `personal_msg` (`Name_Index`,`Name`,`Job_Num`,`Tittle`,`department`) VALUES ('','$name','$gonghao','$zhiwei','$bumen')";
            $stt =insert($db,$sql);
            //print_r('插入成功 ' .$stt);
            // 通过网页形式显示
            // echo "<script language=\"JavaScript\">alert(\"插入成功\");history.back();</script>";
            // echo "<script>parent.layer.closeAll();parent.layer.alert('插入成功');</script>";
            echo "<script>parent.layer.closeAll();parent.location.reload();</script>";//关闭弹窗；重载父窗口
        }
    }
  }

?>

<script>
//Demo
layui.use('form', function(){
  var form = layui.form;
  
});
</script>
</body>
</html>