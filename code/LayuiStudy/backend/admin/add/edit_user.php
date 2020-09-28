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
$showRole=find_ID_name('role_msg',$db,'role_id='.$value['role_id']);
echo "&nbsp";
//获取想要修改行的信息
?>

<form class="layui-form" action="" method="post">

  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-inline">
      <input type="text" name="name" id="name" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['name'];?>>
    </div>
   </div>

   <div class="layui-form-item">
    <label class="layui-form-label">角色</label>
    <div class="layui-input-inline">
      <select name="role" id="role">
        <?php

              $sttName = find_one_all('role_msg',$db,'role_id>0','role'); 

            ?>

            <?php  
                  //获取长度
                  $arrlength1=count($sttName[0]);   
  
                  for ($i=1; $i<=$arrlength1-1; $i++){
                ?><option value="<?php echo $sttName[0][$i]['role'];?>"><?php echo $sttName[0][$i]['role'];?></option>
                <?php 
                   }
                ?>   
      </select>
    </div>
  </div><br><br><br>

   
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
  if (isset($_POST['submit'])) {
    if ($_POST['name']=='') {//检测输入是否为空或空格
      echo "<script>parent.layer.alert('输入不能为空');
      </script>";
    }
    else{//调用函数save()修改数据库
      $getDate=find_ID_name('role_msg',$db,'role="'.$_POST['role'].'"');//在角色表中查找角色信息
      $values="name='".$_POST['name']."',role_id=".$getDate[0][0]['role_id']; //新修改的用户名和角色id  
      save($_GET["tableName"],$db,$values,$_GET["index"]);//调用函数库中的save；
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
var n=op.length;
for(var i =0;i<n;i++){
  if (op[i].value==<?php echo "'".$showRole[0][0]['role']."'";?>) {
    op[i].selected=true;
  }
}

</script>
</body>
</html>