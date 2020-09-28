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
$where='Category_Index='.$value['Category_Index'];
$getCategoryName=find_ID_name('category_msg',$db,$where);
echo "&nbsp";
//获取想要修改行的信息
// $where='Category_Index='.$value[$i]['Category_Index'];
// $getCategoryName=find_ID_name('category_msg',$db,$where);
?>

<form class="layui-form" action="" method="post" style="padding-right: 25px">

  <div class="layui-form-item">
    <label class="layui-form-label">考核类型</label>
    <div class="layui-input-inline">
      <select id="category" class="select" name="category" >
            <option value="">请选择考核类型</option>
            <?php  
              $sttName = find_one_all('category_msg',$db,'Category_Index>0','Category_Name');  
                $arrlength=count($sttName[0]);     
                for ($i=0; $i<=$arrlength-1; $i++){
              ?>
                <option value="<?php echo $sttName[0][$i]['Category_Name'];?>"><?php echo $sttName[0][$i]['Category_Name'];?></option>
              <?php 
                 }
              ?>
        </select>
    </div>
   </div>

  <div class="layui-form-item">
    <label class="layui-form-label">考核内容</label>
    <div class="layui-input-inline">
      <input type="text" name="content" id="content" class="layui-input" autocomplete="off" placeholder="请输入考核内容" onkeyup="this.value=this.value.replace(/ /g,'')" value=<?php echo $value['connent'];?> >
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
    $check=$_POST['category']==''||$_POST['content']=='';
    
    if ($check) {
      echo "<script>parent.layer.alert('输入不能为空');</script>";
    }
    else{//调用函数save()修改数据库
      $where='Category_Name="'.$_POST['category'].'"';
      $getCategoryID=find_ID_name('category_msg',$db,$where);
      $CategoryID=$getCategoryID[0][0]['Category_Index'];
      $value="Category_Index='".$CategoryID."',connent='".$_POST['content']."'";
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
  if (op[i].value==<?php echo "'".$getCategoryName[0][0]['Category_Name']."'"; ?>) {
    op[i].selected=true;
  }
}

</script>
</body>
</html>