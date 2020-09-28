<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>QKM培训中心管理系统</title>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script type="text/javascript" src="layui/layui.js"></script>
	<style type="text/css">
		.header{width: 100%;height: 50px;line-height: 50px;background:#628DB6;color: #fff;}
		.title{margin-left: 20px;font-size: 20px;}
		.userinfo{float: right;margin-right: 10px;}
		.userinfo a{color: #fff;}
		.menu{width: 200px;background: #444C63;position: absolute;}
		.main{position: absolute;left: 200px;right: 0px;height: 90%}
		.layui-collapse{border: none;}
		.layui-colla-item{border-top: none;}
		.layui-colla-title{background: #42485b;color: #fff;}
		.layui-colla-content{border-top: none;padding: 0px}
	</style>
</head>
<body>
	<!-- 头部-->
	<div class="header">
		<span class="title">QKM培训系统- - 培训中心管理系统</span>
		<span class="userinfo"><span id="username">admin  [系统管理员]</span><span> <a href="javascript:;" onclick="logout()"> 退出 </a> </span></span>
	</div>
	<!--菜单-->
		<div class="menu" id ="menu">
			<div class="layui-collapse" lay-accordion>
	  			<div class="layui-colla-item">
	    			<h2 class="layui-colla-title">基本信息</h2>
	    			<div class="layui-colla-content">
	    				<ul class="layui-nav layui-nav-tree" lay-filter="test">
							  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src ="admin.php">人员信息列表</a></li>
							  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src ="result.php">考核信息查询</a></li>
						</ul>
	    			</div>
	  			</div>
	  			<div class="layui-colla-item">
				    <h2 class="layui-colla-title">考核记录</h2>
				    <div class="layui-colla-content">
				    	<ul class="layui-nav layui-nav-tree" lay-filter="test">
							  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src ="ResultConnect.php">个人成绩</a></li>
							   <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src ="charts.php">数据分析</a></li>
						</ul>
				    </div>
		  		</div>
		  		<div class="layui-colla-item">
		    		<h2 class="layui-colla-title">数据录入</h2>
		    		<div class="layui-colla-content">
		    			<ul class="layui-nav layui-nav-tree" lay-filter="test">
		    				  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFireLimited(this)" src ="addpersonal.php">新增考核人员</a></li>
		    				  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFireLimited(this)" src ="addTypeCont.php">新增考核条例</a></li>
							  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFireLimited(this)" src ="operation.php">考核成绩录入</a></li>
							  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFireLimited(this)" src ="ExcelRW.php">考核Excel导入</a></li>
						</ul>
		    		</div>
		  		</div>
		  		<div class="layui-colla-item">
		    		<h2 class="layui-colla-title">权限设置</h2>
		    		<div class="layui-colla-content">
		    			<ul class="layui-nav layui-nav-tree" lay-filter="test">
							  <li class="layui-nav-item"><a href="javascript:;" onclick="menuFireLimited(this)" src ="permission.php">权限设置</a></li>
						</ul>
		    		</div>
		  		</div>
			</div>
		</div>
			</div>
		</div>

		

	<!---主操作页面---->
	<div class="main">
		<iframe src="welcome.php" onload="resetMainHeight(this)" style="width: 100%;height: 100%;" frameborder="0" scrolling="yes"></iframe>

	</div>

	<!---脚注---->
	<div style="background: #fff; 
					position:fixed; 
					bottom: 0; 
					width: 100%;
					border-top: #000 1px solid;
					font-size: 12px;
					text-align: center;
					padding: 10px 0;  " >
			<p>Copyright ® 2018. All rights reserved.&nbsp;&nbsp;&nbsp;Version-V1.1.&nbsp;&nbsp;yma &nbsp;&nbsp;&nbsp;&nbsp;服务器【QKM237 内测版】-台式机</p>
		</div>



<?php

    session_start();
    require  'function.php';
    echo "<script>var permission=".$_SESSION['pmsArray'].";</script>";
    if (empty($_SESSION['username'])) {//如果用户名为空则转到登录界面，防止不通过登录直接访问home.php
      echo '<script>alert("请您先登录！");window.location.href="login.php";</script>';
    }
    else{//显示用户名
      echo '<script>var username="'.$_SESSION['username'].'";
      document.getElementById("username").innerHTML=username;</script>';
    }
	    
?>

	<script>
		layui.use(['element', 'layer'], function(){
		  var element = layui.element;
		  var layer = layui.layer;
		  $=layui.jquery;
		  resetMenuHeight();
		});
		function logout(){
		layer.confirm('确定要退出吗？', {
  			icon:3,
  			btn: ['确定', '取消' ] //可以无限个按钮
		}, function(index, layero){
  		//按钮【按钮一】的回调
  		window.location.href='login.php';//退出后回到登录界面。

		}, function(index){
  		//按钮【按钮二】的回调
		});
		}
		//重新设置菜单容器的高度
		function resetMenuHeight(){
			var height = document.documentElement.clientHeight - 50;
			$('#menu').height(height)
		}

		//菜单点击
		function menuFire(obj){
			//获取url
			var src = $(obj).attr('src')
			//改变框架内的页面地址
			$('iframe').attr('src',src)
		}
		//设置主操作页面高度
		function resetMainHeight(obj){
			var height = parent.document.documentElement.clientHeight - 50;
			$(obj).parent('div').height(height)
		}

		//受权限限制的菜单
		function menuFireLimited(obj){
			if (permission.includes('2')){
				if($(obj).attr('src')=="permission.php"){
					if (permission.includes('1')) {
						var src = $(obj).attr('src');
						$('iframe').attr('src',src)
					}
					else{
						layer.alert('抱歉，您无此权限！');
					}	
				}
				else{
					var src = $(obj).attr('src');
					$('iframe').attr('src',src)
				}
			}

			else{
				layer.alert('抱歉，您无此权限！');
			}
		}

	</script>
</body>
</html>