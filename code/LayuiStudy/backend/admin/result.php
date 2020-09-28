<!-- 
说明：该模块是查询考核记录的模块；
开始时间：7/22/2020
开发人：Masir
版本：测试版V1.1
历史版本：
20200724 - 完成单表查询和多表查询
20200726 - 完成表格筛选
 -->


<?php
/*
概述：本模块是为了显示个人成绩统计
*/

require 'function.php';
session_start();


?>

<!DOCTYPE html>
<html>
<head>
  <title>成绩显示</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
  <script type="text/javascript" src="layui/layui.js"></script>
  <style type="text/css">
  body,html{height: 100%}

  .check{height:20px;width:200px;font-size: 16px;margin-left: 5px;margin-top: 5px;} 
  .leftblock{background-color:#FFFFDD;width:100%;float:left;}
  .rightblock{background-color:#FFFFFF;height:85%;width:100%;float:right;}   
  .title{ margin-left:15px;margin-top:5px;width:15%;float:left;font-size:8px;}
  .message{float:left;width:100%; margin-top:1px;height: 25%;margin-left: 15px;}
  .p1{margin-top:10px;font-size:15px;float:left;margin-left: 25px;}
  .p2{font-size:10px;float:left; }
  .selectID{font-size:13px;height: 28px;width: 200px;margin-top: 1px;margin-left: 10px;}
  .time{font-size: 18px;margin-left: 5px;}
  .layui-btn1{margin-top: 10px;margin-left: 50px;width: 100px; height: 30px;}
  .layui-table thead tr{background-color: #009688;color:#fff }
  </style>
</head>

<body>
  <div class ="leftblock">
  <div class ="title">
    <h1>---成绩查询---</h1>   
  </div>

  

  <form class="layui-form1" id="form1" method="post" action="result.php">
    <div class="message">
      <h2 class="p1">姓名
        <select name="name" type="text" class="selectID" onchange="submit()">
          <option value="">请选择查询的人员 </option>
            <?php
              //从数据库personal中提取人名
              $sttName = find_one_all('personal_msg',$db,'Name_Index>0','Name'); 
            ?>
            <?php  
                  //获取长度
                  $arrlength1=count($sttName[0]);   
                  //循环获取人员信息  
                  for ($i=0; $i<=$arrlength1-1; $i++){
                ?>
                <option onmouseover="changeOptColor(this)" value="<?php echo $sttName[0][$i]['Name'];?>"><?php echo $sttName[0][$i]['Name'];?></option>
                <?php 
                   }
                ?>        
        </select>     
      </h2>

      <h2 class="p1">类别
        <select name="type" type="text" class="selectID" onchange="goSubmit();">
          <option value="">请选择查询的类别</option>
          <?php
            //从数据库personal中提取人名
            $sttName = find_one_all('category_msg',$db,'Category_Index>0','Category_Name');  
          ?>
          <?php  
                //获取数据库中类型
                $arrlength2=count($sttName[0]);   
                //循环获取人员信息  
                for ($i=0; $i<=$arrlength2-1; $i++){
              ?>
                <option value="<?php echo $sttName[0][$i]['Category_Name'];?>"><?php echo $sttName[0][$i]['Category_Name'];?></option>
              <?php 
                //$str = $sttName[0][$i]['Category_Name'];
                 }
              ?>
        </select>
      </h2>

      <h2 class="p1">内容
        <select id="content" name="content" type="text" class="selectID" onchange="submit();">
          <option value="">请选择查询的内容</option>
          <?php
            //从数据库personal中提取人名
            $str = $_POST['type'];
            $typename = 'Category_Name='."'$str'";
            $getTypeID =find_ID_name('category_msg',$db,$typename);
            $sttName = find_one_all('category_msg_content',$db,'Category_Index='.$getTypeID[0][0]['Category_Index'],'connent');  
          ?>
          <?php  
                //获取数据库中类型
                $arrlength3=count($sttName[0]);   
                //循环获取人员信息  
                for ($i=0; $i<=$arrlength3-1; $i++){
              ?>
                <option value="<?php echo $sttName[0][$i]['connent'];?>"><?php echo $sttName[0][$i]['connent'];?></option>
              <?php 
                //$str = $sttName[0][$i]['Category_Name'];
                 }
              ?>
        </select>


      </h2>

      <!-- <h2 class="p1">日期
        <label class="time">      
              <input class="selectID" type="date" name="time" lay-verify="required|phone" autocomplete="off" class="layui-input">      
        </label><br>
    
      </h2> -->
  
    </div>


  </form> 
  <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" onclick="multiDel()" style="float: right;">批量删除</button>

  </div>

  <?php

    if (empty($_POST['name'])&&empty($_POST['type'])) {//不查询，输出全部
              $stt =find_ID_All('common_grade',$db);
              
    }
    
  
    if (!empty($_POST['name'])&&empty($_POST['type'])) {//仅输入姓名查询
              $str = $_POST['name'];
              $name = 'Name='."'$str'";
              $stt =find_ID_name('common_grade',$db,$name);
              
              
    }
    if (!empty($_POST['type'])&&empty($_POST['name'])) {//仅输入类型查询
              $str = $_POST['type'];
              $type = 'Category='."'$str'";
              $stt =find_ID_name('common_grade',$db,$type);

              
              
    }
    if (empty($_POST['name'])&&!empty($_POST['type'])&&!empty($_POST['content'])) {//类型和内容双重查询
              $str1 = $_POST['type'];
              $str2 = $_POST['content'];
              $find = 'Category='."'$str'and Content='$str2' ";
              $stt =find_ID_name('common_grade',$db,$find);
              
              
              
    }
    if(!empty($_POST['type'])&&!empty($_POST['name'])) {//姓名类型双重查询
                $str1 = $_POST['name'];
                $str2 = $_POST['type'];
                $name1 = 'Name='."'$str1' and Category='$str2' ";
                $stt =find_ID_name('common_grade',$db,$name1);
                
                
    }
    if(!empty($_POST['type'])&&!empty($_POST['name'])&&!empty($_POST['content'])) {//三重查询
                $str1 = $_POST['name'];
                $str2 = $_POST['type'];
                $str3 = $_POST['content'];
                $find = "Name='$str1' and Category='$str2' and Content='$str3'" ;
                $stt =find_ID_name('common_grade',$db,$find);
                
                
    }

    if (!empty($stt)){
            $arrlength=count($stt[0]);     
    }
    else{
      print_r("还未参加技术中心考核，暂无数据！");
    }
    
    

   ?>

    <div class="rightblock">
        
      <table class="layui-table" lay-data="{page:true ,toolbar:true ,groups: 1,limit:20}" >
        <thead>
          <tr>
            <th lay-data="{field:'box', width:'5%',type:'checkbox'}"></th>
            <th lay-data="{field:'ID', width:'6%', sort: true}" >ID</th>
            <th lay-data="{field:'Name', width:'10%', sort: true}">考核人</th>
            <th lay-data="{field:'Category', width:'13%', sort: true}">考核类型</th>
            <th lay-data="{field:'Content', width:'22%', sort: true}">考核内容</th>
            <th lay-data="{field:'people', width:'10%', sort: true}">监考人</th>
            <th lay-data="{field:'Date', width:'16%', sort: true}">考核时间</th>
            <th lay-data="{field:'Grade', width:'8%', sort: true}">得分</th>
            <th lay-data="{field:'caozuo', width:'10%', sort: false}">操作</th>
          </tr>
        </thead>

        <tbody> 

            <?php 
            foreach($stt as $key => $value){
                for($i=0; $i<=$arrlength-1; $i++){
              ?>
                  
            <tr>
                <td lay-data="{field:'box'}"></td>
                <td lay-data="{field:'ID'}"><?php echo $i+1;?></td>
                <td lay-data="{field:'Name'}"><?php echo $value[$i]['Name'];?></td>
                <td lay-data="{field:'Category'}"><?php echo $value[$i]['Category'];?></td>
                <td lay-data="{field:'Content'}"><?php echo $value[$i]['Content'];?></td>
                <td lay-data="{field:'people'}"><?php echo $value[$i]['people'];?></td>
                <td lay-data="{field:'Date'}"><?php echo $value[$i]['Date'];?></td>
                <td lay-data="{field:'Grade'}"><?php echo $value[$i]['Grade'];?></td>
                <td>
                    <button class="layui-btn layui-btn-xs" onclick="edit(<?php echo $value[$i]['common_id'];?>)" value=<?php echo $value[$i]['common_id'];?>>编辑</button>
                    <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del(<?php echo $value[$i]['common_id'];?>)">删除</button>
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



<?php 
    echo "<script>var permission=".$_SESSION['pmsArray'].";</script>"; 
?>


<?php
      if (isset($_POST['name'])||isset($_POST['type'])) {
        ?>
        <script type="text/javascript">
          var op=document.getElementsByTagName('option');
          var n=op.length;
          for(var i =0;i<n;i++){
            if (op[i].value==<?php echo "'".$_POST['name']."'";?>) {
                op[i].selected=true;
            }
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

  function goSubmit() {
    document.getElementById('form1').submit();
  }

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
      xmlhttp.open("GET","add/del.php?tableName=common_grade&index=common_id="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
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
    window.alert("测试");
  }

  function getContent(value){

    //alert('123');
    alert("选中的值是"+value);
  }

  //编辑
  function edit(x){
      if (permission.includes('2')) {
      var ifr=layer.open({
      type: 2, 
      title:'修改管理员信息',
      area:['400px','500px'],
      content: 'add/edit_result.php?tableName=common_grade&index=common_id='+x //在iframe弹窗打开edit.php，并传入表名和想要删除行的Name_Index
      });
      }
      else{
        nopms();
      }
    }

    function nopms(){
      layer.alert('抱歉，您无此权限！');
    }

    if (!permission.includes('2')) {
      grey();
    }

    function goSubmit() {
      document.getElementById('content').value='';
      document.getElementById('form1').submit();
    }

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
            var t=inp[i].parentElement.parentElement.parentElement.children[7].children[0].children[0].value;
            if (x==null) {
              x='common_id ='+t;
            }
            else{
              x=x+' OR common_id='+t;
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
      xmlhttp.open("GET","add/del.php?tableName=common_grade&index="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
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