<?php
require 'function.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>注册</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="layui/css/layui.css">
  <script type="text/javascript" src="layui/layui.js"></script>
</head>
<body>

      <div style="background: #fff; padding:50px">
        <form class="layui-form" action="" method="post">
          <div class="layui-form-item" style="color: gray">
            <h2>注册QKM后台管理系统</h2>
          </div>
          <hr>

          <div class="layui-form-item">
              <label class="layui-form-label">用户名</label>
              <div class="layui-input-block">
                <input type="text" name="username" id="username" placeholder="请输入用户名" autocomplete="off" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')">
             </div>
          </div>

          <div class="layui-form-item">
              <label class="layui-form-label">密码</label>
              <div class="layui-input-block">
                <input type="password" name="password" id="password"  placeholder="请输入密码" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')">
             </div>
          </div>

          <div class="layui-form-item">
              <label class="layui-form-label">确认密码</label>
              <div class="layui-input-block">
                <input type="password" name="password1" id="password1"  placeholder="请确认密码" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')">
             </div>
          </div>

          <div class="layui-form-item">

                    <div class="layui-input-block";>
                        <input type="submit" name="submit" value="注册" class="layui-btn">
                        <input type="button" value="取消" class="layui-btn" onclick="parent.layer.closeAll()" >
                    </div>
                    
                </div>
        </form>
      </div>

<?php
if (isset($_POST['submit'])) {
    $check1=$_POST['username']==' '||$_POST['username']=='';
    $check2=$_POST['password']==' '||$_POST['password']=='';
    $check3=$_POST['password1']==' '||$_POST['password1']=='';
    if ($check1||$check2||$check3) {//检测注册的用户名或密码是否为空或空格
      echo "<script>parent.layer.alert('输入不能为空');
      document.getElementById('username').value='".$_POST['username']."';
      document.getElementById('password').value='".$_POST['password']."';
      document.getElementById('password1').value='".$_POST['password1']."';
      </script>";
    }
    else{
      if ($_POST['password']!=$_POST['password1']) {//检验两次输入的密码是否相同
        echo "<script>parent.layer.alert('两次输入的密码不同，请重新输入！');
        document.getElementById('username').value='".$_POST['username']."';
        </script>";
      }
      else{
        $stt = findlogin('tb_login',$db,'name="'.$_POST['username'].'"');//调用函数findlogin搜索数据库
        if ($stt[0][0]['name']!='') {//检验输入的用户名是否与数据库里的记录有重复
          echo "<script>parent.layer.alert('用户名重复！');</script>";
        }
        else{
          date_default_timezone_set("PRC");
          $date=date('Y-m-d H:i:s');
          $sql="INSERT INTO tb_login (name, password,register_date,role_id) 
          VALUES ('".$_POST['username']."','".$_POST['password']."','".$date."',3)";
          // echo $sql;
          $res=insert($db,$sql);//调用函数insert在数据库中新增注册信息
          echo "<script>parent.layer.closeAll();parent.layer.alert('注册成功<br>$date');</script>";
         
        }
      }
    }
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
    
   
  </script>
</body>
</html>