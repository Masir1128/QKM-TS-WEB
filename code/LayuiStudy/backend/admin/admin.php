<?php
session_start();
require 'function.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>QKM培训人员列表</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
  <script type="text/javascript" src="layui/layui.js"></script>
  <style type="text/css">
  .header span{background: #009688;color: #fff;padding: 10px;margin-left: 30px;line-height: 32px;}
  .header button{margin: auto 10px; float: right;}
  .header{border-bottom: 2px #009688 solid;}
  .layui-table thead tr{background-color: #009688;color:#fff }
  </style>
</head>
<body style="padding: 10px;" >
<div class="header">
  <span>QKM培训人员列表</span>  
      <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" onclick="multiDel()">批量删除</button>
      <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" onclick="add()">添加</button>
</div>



<table class="layui-table" lay-filter="test" lay-data="{page:true ,toolbar:true ,groups: 2,limit:20}" >
  <thead >
    <tr>
      <th lay-data="{field:'box', width:'5%',type:'checkbox'}"></th>  <!-- 这是layui内置的设置表格复选框的方法 -->
      <th lay-data="{field:'Name_Index', width:'10%', sort: true}" >ID</th>
      <th lay-data="{field:'Name', width:'15%', sort: true}">姓名</th>
      <th lay-data="{field:'Job_Num', width:'15%', sort: true}">工号</th>
      <th lay-data="{field:'Tittle', width:'20%', sort: true}">职位</th>
      <th lay-data="{field:'department', width:'20%', sort: true}">部门</th>
      <th lay-data="{field:'caozuo', width:'15%', sort: false}" >操作</th>
    </tr>
  </thead>
    <tbody> 
      <?php 
        $result =find_ID_All('personal_msg',$db);     //获取人员信息表的所有信息
        $arrlength=count($result[0]);                 //获取表格长度,也就是行数
        foreach($result as $rows){
          for($i=0; $i<=$arrlength-1; $i++){
      ?>
        <tr>
          <td lay-data="{field:'box'}"></td>
          <td lay-data="{field:'Name_Index'}"><?php echo $i+1;?></td>
          <td lay-data="{field:'Name'}"><?php echo $rows[$i]['Name'];?></td>
          <td lay-data="{field:'Job_Num'}"><?php echo $rows[$i]['Job_Num'];?></td>
          <td lay-data="{field:'Tittle'}"><?php echo $rows[$i]['Tittle'];?></td>
          <td lay-data="{field:'department'}"><?php echo $rows[$i]['department'];?></td>
          <td>
          <button class="layui-btn layui-btn-xs"  onclick="edit(<?php echo $rows[$i]['Name_Index'];?>)" value=<?php echo $rows[$i]['Name_Index'];?>>编辑</button>
          <button class="layui-btn layui-btn-danger layui-btn-xs"  onclick="del(<?php echo $rows[$i]['Name_Index'];?>)">删除</button>
          </td>
        </tr>
      <?php 
          } 
        }
      ?>


    </tbody>
</table>


<br><br><br>


<?php
      echo "<script>var permission=".$_SESSION['pmsArray'].";</script>";   
?>



<script>
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

    //删除
    function del(x){//传入准备删除行的Name_Index
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
      xmlhttp.open("GET","add/del.php?tableName=personal_msg&index=Name_Index="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
      xmlhttp.send();
    }, function(){
      //按钮【按钮二】的回调
    });
    }
    else{
      nopms();
    }
    }

    //添加
    function add(){
       if (permission.includes('2')) {
       layer.open({
       type: 2, 
       title:'添加管理员',
       area:['400px','360px'],
       content: 'add/add.php', //在弹窗中打开页面
      });
       } 
      else{
        nopms();
      } 
    }

    //编辑
    function edit(x){
      if (permission.includes('2')) {
      layer.open({
      type: 2, 
      title:'修改管理员信息',
      area:['400px','360px'],
      content: 'add/edit_admin.php?tableName=personal_msg&index=Name_Index='+x //在弹窗打开edit.php，并传入表名和想要删除行的Name_Index
      }); 
      } 
      else{
        nopms();
      } 
    }


    //当用户无权限时触发受限功能弹出此框
    function nopms(){
      layer.alert('抱歉，您无此权限！');
    }


    //批量删除
    function multiDel() {
      if (permission.includes('2')) {
      layer.confirm('确定要删除吗？', {
        icon:2,
        btn: ['确定', '取消' ] //可以无限个按钮
    }, function(){
        var inp=document.getElementsByTagName('input');
        var x=null;
        for (var i = 1; i < inp.length; i++) {
          if (inp[i].checked==true) {
            var t=inp[i].parentElement.parentElement.parentElement.children[6].children[0].children[0].value;
            if (x==null) {
              x='Name_Index ='+t;
            }
            else{
              x=x+' OR Name_Index='+t;
            }
          }
        }    
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
      xmlhttp.open("GET","add/del.php?tableName=personal_msg&index="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
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