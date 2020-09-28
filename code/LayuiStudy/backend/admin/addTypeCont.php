<?php
session_start();
require 'function.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>数据库操作</title>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script type="text/javascript" src="layui/layui.js"></script>
	<style type="text/css">
	.leftblock{width: 50%; padding: 20px;float: left;margin-left:1.5%;}
  .rightblock{float: right;width: 40%;padding: 20px;margin-right:1.5%;}
	.message{width:100%; margin-top:1px;margin-left: 15px;}
	.p1{margin-top:10px;font-size:18px;margin-left: 25px;float:left;}
	.selectID{font-size:13px;height: 28px;width: 200px;margin-top: 1px;margin-left: 10px;}
	.select{height: 33px;width: 228px;margin-top: 20px;margin-left: 30px;}
  .header span{background: #009688;color: #fff;padding: 10px;margin-left: 30px;line-height: 32px;}
  .header button{margin: auto 10px; float: right;}
  .header{border-bottom: 2px #009688 solid;}
  .layui-table thead tr{background-color: #009688;color:#fff }
	</style>
</head>

<body>





<div class="leftblock">


   <div class="header">
  <span>考核内容表</span>  
      <button type="button" form="form1" class="layui-btn layui-btn-sm layui-btn-normal" onclick="add2()">新增</button>
</div>

  <table class="layui-table" lay-data="{page:false ,toolbar:false,groups:2,limit:1000}" >
        <thead>
          <tr>
            <th lay-data="{field:'ID', width:'10%', sort: true}" >ID</th>          
            <th lay-data="{field:'Category', width:'20%', sort: true}">考核类型</th>
            <th lay-data="{field:'Content', width:'45%', sort: true}">考核内容</th>
            <th lay-data="{field:'cuozuo', width:'25%', sort: false}">操作</th>
          </tr>
        </thead>

        <tbody> 

            <?php 
            $stt =find_ID_All('category_msg_content',$db);
            $arrlength=count($stt[0]);
            foreach($stt as $key => $value){
                for($i=0; $i<=$arrlength-1; $i++){
                  $where='Category_Index='.$value[$i]['Category_Index'];
                  $getCategoryName=find_ID_name('category_msg',$db,$where);
              ?>
                  
            <tr>
                <td lay-data="{field:'ID'}"><?php echo $i+1;?></td>
                <td lay-data="{field:'Category'}"><?php echo $getCategoryName[0][0]['Category_Name'];?></td>
                <td lay-data="{field:'Content'}"><?php echo $value[$i]['connent'];?></td>
                <td>
                    <button class="layui-btn layui-btn-xs" onclick="edit2(<?php echo $value[$i]['Category_Index_ID'];?>)" value=<?php echo $value[$i]['Category_Index'];?>>编辑</button>
                    <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del2(<?php echo $value[$i]['Category_Index_ID'];?>)">删除</button>
                </td>
            </tr>
          <?php 
            } 
            }
          ?>

        </tbody>
      </table>
      <br><br><br>

</div>


<div class="rightblock">
  <div class="header">
  <span>考核类型表</span>  
      <button type="button" form="form1" class="layui-btn layui-btn-sm layui-btn-normal" onclick="add1()">新增</button>
</div>

  <table class="layui-table" lay-data="{page:false ,toolbar:false,groups:2,limit:20}" >
        <thead>
          <tr>
            <th lay-data="{field:'ID', width:'20%', sort: true}" >ID</th>          
            <th lay-data="{field:'Category', width:'50%', sort: true}">考核类型</th>
            <th lay-data="{field:'cuozuo', width:'30%', sort: false}">操作</th>
          </tr>
        </thead>

        <tbody> 

            <?php 
            $stt =find_ID_All('category_msg',$db);
            $arrlength=count($stt[0]);
            foreach($stt as $key => $value){
                for($i=0; $i<=$arrlength-1; $i++){
              ?>
                  
            <tr>
                <td lay-data="{field:'ID'}"><?php echo $i+1;?></td>
                <td lay-data="{field:'Category'}"><?php echo $value[$i]['Category_Name'];?></td>
                <td>
                    <button class="layui-btn layui-btn-xs" onclick="edit1(<?php echo $value[$i]['Category_Index'];?>)" value=<?php echo $value[$i]['Category_Index'];?>>编辑</button>
                    <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del1(<?php echo $value[$i]['Category_Index'];?>)">删除</button>
                </td>
            </tr>
          <?php 
            } 
            }
          ?>

        </tbody>
      </table>
</div>

<?php
      if (isset($_POST['type'])) {
        ?>
        <script type="text/javascript">
          var op=document.getElementsByTagName('option');
          var n=op.length;
          for(var i =0;i<n;i++){
            if (op[i].value==<?php echo "'".$_POST['type']."'";?>) {
                op[i].selected=true;
            }
            if (op[i].value==<?php echo "'".$_POST['content']."'";?>) {
                op[i].selected=true;
            }
          }
        </script>

        <?php
      }
      ?>



<?php
      echo "<script>var permission=".$_SESSION['pmsArray'].";</script>";   
?>
	<script type="text/javascript">

		layui.use(['layer'], function(){
		  var element = layui.element;
		  var layer = layui.layer;
		});
		layui.use('table', function(){
		    var table = layui.table;
		  
		});
		layui.use('form', function(){
		var form = layui.form;
		});

    function goSubmit() {
      document.getElementById('content').value='';
      document.getElementById('form1').submit();
    }

		//添加
    function add1(){
      if (permission.includes('2')) {
       layer.open({
       type: 2, 
       title:'新增考核内容',
       area:['400px','200px'],
       content: 'add/add_category.php', //在弹窗中打开页面
      });
       } 
      else{
        nopms();
      } 
    }

    function add2(){
      if (permission.includes('2')) {
       layer.open({
       type: 2, 
       title:'新增考核内容',
       area:['400px','270px'],
       content: 'add/add_content.php', //在弹窗中打开页面
      });
       } 
      else{
        nopms();
      } 
    }

    //编辑
    function edit1(x){
      if (permission.includes('2')) {
      layer.open({
      type: 2, 
      title:'修改考核内容',
      area:['400px','200px'],
      content: 'add/edit_category.php?tableName=category_msg&index=Category_Index='+x //在弹窗打开edit.php，并传入表名和想要删除行的Name_Index
      }); 
      } 
      else{
        nopms();
      } 
    }

    function edit2(x){
      if (permission.includes('2')) {
      layer.open({
      type: 2, 
      title:'修改考核内容',
      area:['400px','270px'],
      content: 'add/edit_content.php?tableName=category_msg_content&index=Category_Index_ID='+x //在弹窗打开edit.php，并传入表名和想要删除行的Name_Index
      }); 
      } 
      else{
        nopms();
      } 
    }

    //删除
    function del1(x){//传入准备删除行的Name_Index
    if (permission.includes('2')) {
      layer.confirm('确定要删除吗？', {
        icon:2,
        btn: ['确定', '取消' ] //可以无限个按钮
    }, function(){
        var xmlhttp= new XMLHttpRequest();//创建XMLHttprequest对象
        xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4&&xmlhttp.status==200) {
          layer.closeAll();
          layer.load(1, {//显示加载中圆圈
            shade: [0.1,'#fff'] //0.1透明度的白色背景
          });
          location.reload();//当请求已完成时，刷新本页面
          
        }
      } 
      xmlhttp.open("GET","add/del.php?tableName=category_msg&index=Category_Index="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
      xmlhttp.send();
    }, function(){
      //按钮【按钮二】的回调
    });
    }
    else{
      nopms();
    }
    }

    function del2(x){//传入准备删除行的Name_Index
    if (permission.includes('2')) {
      layer.confirm('确定要删除吗？', {
        icon:2,
        btn: ['确定', '取消' ] //可以无限个按钮
    }, function(){
        var xmlhttp= new XMLHttpRequest();//创建XMLHttprequest对象
        xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4&&xmlhttp.status==200) {
          layer.closeAll();
          layer.load(1, {//显示加载中圆圈
            shade: [0.1,'#fff'] //0.1透明度的白色背景
          });
          location.reload();//当请求已完成时，刷新本页面
          
        }
      } 
      xmlhttp.open("GET","add/del.php?tableName=category_msg_content&index=Category_Index_ID="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
      xmlhttp.send();
    }, function(){
      //按钮【按钮二】的回调
    });
    }
    else{
      nopms();
    }
    }

	</script>
</body>


</html>