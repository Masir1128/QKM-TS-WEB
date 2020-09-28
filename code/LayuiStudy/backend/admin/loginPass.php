<?php
require  'function.php';  // 获取数据库信息
//获取登录信息和密码
$name=$_POST['username'];
$pwd=$_POST['password'];
$stt = findlogin('tb_login',$db,'name="'.$name.'"');//将id=1改为所登录的用户名

//Debug 测试数据库
$A = $stt[0][0]['name'];
$B = $stt[0][0]['password'];

//核对登录信息
if ($B==$pwd){//若从数据库中返回的密码与用户输入的密码相同，则登陆成功
	session_start();  //开启会话
	$_SESSION['username']=$A;  // 获取用户名
  	$getInfo=findlogin('tb_login',$db,'name="'.$_SESSION['username'].'"');  			//获取对应用户所有信息
  	$getRole=findlogin('role_msg',$db,'role_id="'.$getInfo[0][0]['role_id'].'"');		//获取用户的角色
  	$_SESSION['pmsArray']=json_encode(explode(",",$getRole[0][0]['permission']));      //获取角色权限

	echo '<script>window.location.href="home.php";</script>';
	//header('Location: home.php?username='.$name);
}else{
	echo '<script>alert(\'登录失败~~\');window.location.href="login.php";</script>';
	//header('Location: http://www.php.demo/LayuiStudy/backend/admin/login.php');
	echo "error";
}
?>