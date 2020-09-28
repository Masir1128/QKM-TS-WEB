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



<?php 
$showDate=find_ID_name($_GET["tableName"],$db,$_GET["index"]);
$value=$showDate[0][0];
echo "&nbsp";
//获取想要修改行的信息

?>

<form class="layui-form" action="" method="post">

  <div class="layui-form-item">
    <label class="layui-form-label">姓名</label>
    <div class="layui-input-inline">
      <input type="text" name="name" id="name" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Name'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">工号</label>
    <div class="layui-input-inline">
      <input type="text" name="id"  id="id" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Job_Num'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">职位</label>
    <div class="layui-input-inline">
      <input type="text" name="bu" id="bu" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Tittle'];?>>
    </div>
   </div>

    <div class="layui-form-item">
    <label class="layui-form-label">部门</label>
    <div class="layui-input-inline">
      <select name="dj" id="dj" lay-verify="required">
        <option value="技术支持部">技术支持部</option>
        <option value="市场部">市场部</option>
        <option value="其它">其它</option>
      </select>
    </div>
  </div>



  <button name="submit" id="submit" type="submit" class="layui-btn" style="margin-left: 30%">修改</button>
  <button name="submit"  type="button" class="layui-btn" onclick="parent.layer.closeAll()" style="margin-right: 30%" >取消</button>
</div>
      
</form>

<!-- 该部分代码是用来获取新增信息，并写入数据库
-----开发时间：2020/06/06
-----遗留问题：还未实现判断，自动不要写入数据库
-----开发者：Masir
 -->

<?php
  if (isset($_POST['submit'])) {//检测输入是否为空或空格
    $check1=$_POST['name']==' '||$_POST['name']=='';
    $check2=$_POST['id']==' '||$_POST['id']=='';
    $check3=$_POST['bu']==' '||$_POST['bu']=='';
    if ($check1||$check2||$check3) {
      echo "<script>parent.layer.alert('输入不能为空');
      document.getElementById('name').value='".$_POST['name']."';
      document.getElementById('id').value='".$_POST['id']."';
      document.getElementById('bu').value='".$_POST['bu']."';
      </script>";
    }
    else{//调用函数save()修改数据库
      $value="Name='".$_POST['name']."',Job_Num=".$_POST['id'].",Tittle='".$_POST['bu']."',department='".$_POST['dj']."'";
      save($_GET["tableName"],$db,$value,$_GET['index']);//调用函数库中的save；
      echo "<script>parent.layer.closeAll();
                    parent.layer.load(1, {
                      shade: [0.1,'#fff'] 
                    });
                    parent.location.reload();</script>";//关闭弹窗；重载父窗口
    }
  }

?>





<script>
//Demo
layui.use('form', function(){
  var form = layui.form;
  
});

var op=document.getElementsByTagName('option');
var n =op.length;
for (var i = 0; i < n; i++) {
  if (op[i].value==<?php echo "'".$value['department']."'"; ?>) {
    op[i].selected=true;
  }
}

</script>
</body>
</html>