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
$showRole=find_ID_name($_GET["tableName"],$db,$_GET["index"]);
$showPms=find_ID_All('permission_msg',$db);
$value=$showRole[0][0];
$pms=json_encode(explode(",",$value['permission']));
echo "&nbsp";
//获取想要修改行的信息
?>

<form class="layui-form" action="" method="post">

      
  <div class="layui-form-item">
    <label class="layui-form-label">角色名</label>
    <div class="layui-input-inline">
      <input type="text" name="rolename" id="rolename" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['role'];?>>
    </div>
   </div>


  <div class="layui-form-item" pane="">
    <label class="layui-form-label">角色权限</label>
    <div class="layui-input-block">
      <?php
        $arrlength=count($showPms[0]);
        for($i=0;$i<$arrlength;$i++){
      ?>
      <input type="checkbox" lay-skin="primary" name="<?php echo "pms".$i;?>" title=<?php echo $showPms[0][$i]['permission'];?> ><br>
   <?php
    }
    ?>
    </div>
  </div>

   
  <button name="submit" id="submit" type="submit" class="layui-btn" style="margin-left: 30%">修改</button>
  <button name="submit"  type="button" class="layui-btn" onclick="parent.layer.closeAll()" style="margin-right: 30%" >取消</button>
</div>
      
</form>


<?php

  if (isset($_POST['submit'])) {

      $y=null;
      for ($i=0; $i <$arrlength ; $i++) { 
        if (isset($_POST['pms'.$i])) {//将新修改的权限组合成一个字符串
          $x=$i+1;
          if (empty($y)) {
            $y=$x;
          }
          else{
            $y=$y.','.$x;
          }
        }
      }

      $values="permission='".$y."'";  
      save($_GET["tableName"],$db,$values,$_GET["index"]);//调用函数库中的save；
      echo "<script>parent.layer.closeAll();
                    parent.layer.load(1, {
                      shade: [0.1,'#fff'] 
                    });
                    parent.location.reload();</script>";//关闭弹窗；重载父窗口
  }

?>





<script>
//Demo
layui.use('form', function(){
  var form = layui.form;  
});

var pmsArray=<?php echo $pms;?>;
var inp=document.getElementsByTagName('input');
var n=inp.length;
for(var i =1;i<n;i++){
  if (pmsArray.includes(i.toString())) {
    inp[i].checked=true;
  }
}

</script>
</body>
</html>