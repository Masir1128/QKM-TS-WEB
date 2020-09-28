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
    <label class="layui-form-label">考核人</label>
    <div class="layui-input-inline">
      <input type="text" name="name" id="name" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Name'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">考核类型</label>
    <div class="layui-input-inline">
      <input type="text" name="type"  id="type" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Category'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">考核内容</label>
    <div class="layui-input-inline">
      <input type="text" name="content" id="content" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Content'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">监考人</label>
    <div class="layui-input-inline">
      <input type="text" name="people" id="people" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['people'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">考核时间</label>
    <div class="layui-input-inline">
      <input type="text" name="date" id="date" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Date'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">得分</label>
    <div class="layui-input-inline">
      <input type="text" name="grade" id="grade" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['Grade'];?>>
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
    $check=$_POST['name']==''||$_POST['type']==''||$_POST['content']==''||$_POST['people']==''||$_POST['date']==''||$_POST['grade']=='';
    if ($check) {
      echo "<script>parent.layer.alert('输入不能为空');
      document.getElementById('name').value='".$_POST['name']."';
      document.getElementById('type').value='".$_POST['type']."';
      document.getElementById('content').value='".$_POST['content']."';
      document.getElementById('people').value='".$_POST['people']."';
      document.getElementById('date').value='".$_POST['date']."';
      document.getElementById('grade').value='".$_POST['grade']."';
      </script>";
    }
    else{
      if (!is_numeric($_POST['grade'])||$_POST['grade']<0||$_POST['grade']>100) {
        echo "<script>parent.layer.alert('请输入0~100之间的分数');
        document.getElementById('name').value='".$_POST['name']."';
        document.getElementById('type').value='".$_POST['type']."';
        document.getElementById('content').value='".$_POST['content']."';
        document.getElementById('people').value='".$_POST['people']."';
        document.getElementById('date').value='".$_POST['date']."';
        document.getElementById('grade').value='';
        </script>";
      }
      else{
        $value="Name='".$_POST['name']."',Category='".$_POST['type']."',Content='".$_POST['content']."',
        people='".$_POST['people']."',Date='".$_POST['date']."',Grade='".$_POST['grade']."'";
        save($_GET["tableName"],$db,$value,$_GET["index"]);//调用函数库中的save；
        echo "<script>parent.layer.closeAll();
                      parent.layer.load(1, {
                        shade: [0.1,'#fff'] 
                      });
                      parent.location.reload();</script>";//关闭弹窗；重载父窗口
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