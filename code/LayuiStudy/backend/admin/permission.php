
<!-- 
说明：该模块是权限模块；
开始时间：7/22/2020
开发人：Masir
版本：测试版V1.1
历史版本：
20200724 - 完成单表查询和多表查询
20200726 - 完成表格筛选
20200811 - 更新表格底色，修改编辑限制
 -->


<?php
session_start();
require  'function.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>权限设置</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
  <script type="text/javascript" src="layui/layui.js"></script>
  <style type="text/css">
  .layui-table thead tr{background-color: #00B6A5;color: #fff}
  .header span{background: #009688;color: #fff;padding: 10px;margin-left: 30px;line-height: 32px;}
  .header button{float: right;}
  .header{border-bottom: 2px #009688 solid;}
  .layui-table thead tr{background-color: #00B6A5;color: #fff}
  </style>
</head>
<body style="padding: 10px;" >

<div style="width: 60%;float: left;">
<div class="header" >
  <span>用户信息</span>
      
</div>
<table id="tab1" class="layui-table" lay-data="{page:true ,toolbar:false ,groups: 2}"  >
  <thead>
    <tr>
      <th lay-data="{field:'name', width:'16%', sort: true}">用户名</th>
      <th lay-data="{field:'password', width:'24%', sort: false}">密码</th>
      <th lay-data="{field:'register_date', width:'24%', sort: true}">注册时间</th>
      <th lay-data="{field:'role', width:'16%', sort: true}">角色</th>
      <th lay-data="{field:'caozuo', width:'20.2%', sort: false}">操作</th>
    </tr>
  </thead>
    <tbody> 
      <?php 
        $result0 =find_ID_All('tb_login',$db);
        $arrlength0=count($result0[0]); 
        foreach($result0 as $rows0){
          for($i=0; $i<=$arrlength0-1; $i++){
            $getRole0=findlogin('role_msg',$db,'role_id="'.$rows0[$i]['role_id'].'"');
      ?>
        <tr>
          <td lay-data="{field:'name'}"><?php echo $rows0[$i]['name'];?></td>
          <td lay-data="{field:'password'}"><?php echo $rows0[$i]['password'];?></td>
          <td lay-data="{field:'register_date'}"><?php echo $rows0[$i]['register_date'];?></td>
          <td name="role" lay-data="{field:'role'}"><?php echo $getRole0[0][0]['role'];?></td>
          <td>
          <button class="layui-btn layui-btn-xs"  onclick="edit1(<?php echo $rows0[$i]['id'];?>)">编辑</button>
          <button class="layui-btn layui-btn-danger layui-btn-xs"  onclick="del1(<?php echo $rows0[$i]['id'];?>)">删除</button>
          </td>
        </tr>
      <?php 
          } 
        }
      ?>


    </tbody>
</table>
</div>



<div style="width: 30%;float: right;margin-right: 5%" >
<div class="header">
  <span>角色权限设置</span>
      <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" onclick="">添加</button>
</div>
<table id="tab2" class="layui-table" lay-data="{page:false ,toolbar:false ,groups: 2}">
  <thead>
    <tr>
      <th lay-data="{field:'role', width:'50%', sort: true}">角色</th>
      <th lay-data="{field:'caozuo', width:'50%', sort: false}">操作</th>
    </tr>
  </thead>
    <tbody> 
      <?php 
        $result =find_ID_All('role_msg',$db);
        $arrlength=count($result[0]); 
        foreach($result as $rows){
          for($i=0; $i<=$arrlength-1; $i++){
            $getRole=findlogin('role_msg',$db,'role_id="'.$rows[$i]['role_id'].'"');
      ?>
        <tr>

          <td name="role" lay-data="{field:'role'}"><?php echo $rows[$i]['role'];?></td>
          <td>
          <button class="layui-btn layui-btn-xs"  onclick="edit2(<?php echo $rows[$i]['role_id'];?>)">编辑</button>
          <button class="layui-btn layui-btn-danger layui-btn-xs" style="background: #A9A9A9" >删除</button>
          <!-- 目前删除功能不支持，若想要删除功能，可加上onclick="del2(<?php echo $rows[$i]['role_id'];?>)" -->
          </td>
        </tr>
      <?php 
          } 
        }
      ?>


    </tbody>
</table>
</div>

<div id="fake" style="display: none;"><!-- //虚假的灰框 -->
  <button class="layui-btn layui-btn-xs" style="background: #A9A9A9">编辑</button>
  <button class="layui-btn layui-btn-danger layui-btn-xs" style="background: #A9A9A9">删除</button>
</div>

<script type="text/javascript">
  layui.use(['layer'], function(){
      var element = layui.element;
      var layer = layui.layer;
    });
    layui.use('table', function(){
        var table = layui.table;
      
    });

  var rolename=document.getElementsByName('role');
  for (var i = 0;i<rolename.length;i++) {
    if (rolename[i].innerHTML=='超级管理员') {
      var num=rolename[i].parentElement.children.length;
      rolename[i].parentElement.children[num-1].innerHTML=document.getElementById('fake').innerHTML;
    }
  }

    //删除用户信息
    function del1(x){
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
      xmlhttp.open("GET","add/del.php?tableName=tb_login&index=id="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
      xmlhttp.send();
    }, function(){
      //按钮【按钮二】的回调
    });
    }

    //删除角色
    function del2(x){
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
      xmlhttp.open("GET","add/del.php?tableName=role_msg&index=role_id="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
      xmlhttp.send();
    }, function(){
      //按钮【按钮二】的回调
    });
    }

    //编辑用户信息
    function edit1(x){
      var ifr=layer.open({
      type: 2, 
      title:'修改用户信息',
      area:['400px','320px'],
      content: 'add/edit_user.php?tableName=tb_login&index=id='+x //在iframe弹窗打开edit.php，并传入表名和想要删除行的Name_Index
      });
    }

    //编辑角色权限
    function edit2(x){
      var ifr=layer.open({
      type: 2, 
      title:'修改角色权限',
      area:['400px','300px'],
      content: 'add/edit_permission.php?tableName=role_msg&index=role_id='+x //在iframe弹窗打开edit.php，并传入表名和想要删除行的Name_Index
      });
    }

</script>
</body>
</html>