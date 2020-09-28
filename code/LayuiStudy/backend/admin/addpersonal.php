<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>人员信息操作</title>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script type="text/javascript" src="layui/layui.js"></script>
	<style type="text/css">
	.operation{height: 400px;width: 100%;background: #FFFFDD; margin-top: 100px;}
	.type{font-size: 15px;margin-left: 100px;}
	.content{font-size: 15px;margin-left: 100px; margin-top: 20px;}
	.people{font-size: 15px;margin-left: 100px;}
	.score{font-size: 15px;margin-left: 100px;}
	.time{font-size: 15px;margin-left: 100px;}
	.layui-btn{margin-left: 120px;margin-top: 40px;}
	.select{height: 33px;width: 228px;margin-top: 20px;margin-left: 30px;}
	</style>
</head>

<body>
	<form class="layui-form" action="addPersonforPHP.php" method="post">
		<div class="operation">

			<label class="type">姓名

			   <input class="select" type="text" name="name" autocomplete="off" placeholder="请输入姓名" onkeyup="this.value=this.value.replace(/ /g,'')">
			    
	   
			</label><br>


			<label class="people">工号

				<input class="select" type="text" name="gonghao" autocomplete="off" placeholder="请输入工号" onkeyup="this.value=this.value.replace(/ /g,'')">
			</label><br>

			<label class="content">职位		

			     <input class="select" type="text" name="zhiwei" autocomplete="off" placeholder="请输入职位" onkeyup="this.value=this.value.replace(/ /g,'')">

			</label><br>

			

			<label class="score">部门

				<input class="select" type="text" name="bumen" placeholder="请输入部门" onkeyup="this.value=this.value.replace(/ /g,'')">

			</label><br>


				<button type="submit" class="layui-btn">新增</button>
		</div>

	</form>

</body>


</html>