<!-- 这是登录页面模块
主要包含的功能为：登陆与注册
登陆读取数据库
注册写入数据库
 -->
 <?php
 	session_start(); 	//开启一个全局变量，用于记录登陆的信息
 	session_unset(); 	//清楚所有登陆的信息，确保安全性
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script type="text/javascript" src="layui/layui.js"></script>

</head>
<body style="background: #FFFFFF">
		<div style="width: 500px;margin: 170px auto 0px">
			<div style="background: #FFEBC1; border-radius: 4px;box-shadow: 5px 5px 20px #4444; padding:20px;">
				<form class="layui-form" action="loginPass.php" method="post" onsubmit="return validateForm()">
					<div class="layui-form-item" style="color: black">
						<h2>QKM培训中心管理系统</h2>
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

                    <div class="layui-input-block";>
                        <input type="submit" value="登录" class="layui-btn">
                        <input type="button" value="注册" class="layui-btn" onclick="register()">
                    </div>
                    
                </div>
				</form>
			</div>
		</div>
		<div style="background: #fff; 
					position:absolute; 
					bottom: 0; 
					width: 100%;
					border-top: #000 1px solid;
					font-size: 12px;
					text-align: center;
					padding: 10px 0;  " >
			<p>Copyright ® 2018. All rights reserved.</p>
		</div>
	<script>
	    layui.use(['layer'], function(){
	      var element = layui.element;
	      var layer = layui.layer;
	    });
	    layui.use('table', function(){
	        var table = layui.table;
	      
	    });
	    function register() {
	       layer.open({
	        type: 2,
	        title: '注册',
	        shade: 0.5,
	        area: ['480px', '400px'],
	        content: ['register.php','no'] //iframe的url，no代表不显示滚动条
	      }); 
	    }
   		
   		// 检测输入是否为空
   		function validateForm(){
		var x=document.getElementById('username').value;  // 获取用户的输入
		var y=document.getElementById('password').value;  // 获取密码的输入
		if (x==''||y==''){
			alert("输入不能为空！");
	  		return false;
		}
		}

  </script>
</body>

</html>

