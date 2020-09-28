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
    <label class="layui-form-label">考核类型</label>
    <div class="layui-input-inline">
      <select id="category" class="select" name="category" >
            <option value="">请选择考核类型</option>
            <?php  
              $sttName = find_one_all('category_msg',$db,'Category_Index>0','Category_Name');  
                //获取数据库中人员信息
                $arrlength=count($sttName[0]);   
                //循环获取人员信息  
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
      <input type="text" name="content" id="content" class="layui-input" autocomplete="off" placeholder="请输入考核内容" >
    </div>
   </div>

<div>
  <button name="submit" id="submit" type="submit" class="layui-btn" style="margin-left:33%;">新增</button>
  <button name="submit"  type="button" class="layui-btn" onclick="parent.layer.closeAll()">取消</button>
</div>
      
</form>

<!-- 该部分代码是用来获取新增信息，并写入数据库
-----开发时间：2020/06/06
-----遗留问题：还未实现判断，自动不要写入数据库
-----开发者：Masir
 -->


<?php


  if (isset($_POST['submit'])) {
    $category=$_POST['category'];
    $content=$_POST['content'];
    if ($category == ""||$content == ''){
    // 通过弹框式显示
    echo "<script>parent.layer.alert('输入不能为空！');</script>";
    }else{
      $check = findlogin('category_msg_content',$db,'connent="'.$content.'"');//调用函数findlogin搜索数据库
        if (!empty($check)) {//检验输入的姓名和工号是否与数据库里的记录有重复
          echo "<script>parent.layer.alert('已存在该考核内容！');</script>";
        }
        else{
          $where='Category_Name="'.$category.'"';
          $getCategoryID=find_ID_name('category_msg',$db,$where);
          $CategoryID=$getCategoryID[0][0]['Category_Index'];
          $sql = "INSERT INTO `category_msg_content` (Category_Index,connent) VALUES ($CategoryID,'$content')";
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