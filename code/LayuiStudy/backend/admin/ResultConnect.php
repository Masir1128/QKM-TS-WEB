<!-- 
说明：该模块是查询个人成绩的模块；
开始时间：7/22/2020
开发人：Masir
版本：测试版V1.1
历史版本：
20200728 - 完成从数据库读取考核内容和考核分数
20200729 - 完成成绩与分数的对齐功能
20200729 - 完成判断去最高分的功能
20200729 - 完成平均分
20200729 - 完成最高分
20200729 - 完成描述模块参数传递,并显示总分
20200806 - 新增考核人和考核时间
 -->

<?php

require 'function.php';		 //引入数据库接口函数
$NScore ='未考核';  			// 定义一个未考核记录的常量
$NPeople ='无记录';  			// 定义一个未考核的记录人


$NumConnnet = 0;  		// 定义一个汇总次数的变量

$TYS = 0; 	//通用总分初始值
$MES = 0;	//机电总分初始值
$SWS = 0;	//软件总分初始值

$TYSA = 0; 	//通用平均总分初始值
$MESA = 0;	//机电平均总分初始值
$SWSA = 0;	//软件平均总分初始值

//判断是否有选择人员，如果没有选择 郭志坚
if( empty($_POST['name']))
{
    //print_r('无提交数据姓名--');
    $str1 = 'XX';
}
else
{
	//print_r('提交姓名!!!');
	$name=$_POST['name'];         //用于传递combo 所提交的姓名
	$str1 = $name ;
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>成绩汇总</title>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script type="text/javascript" src="layui/layui.js"></script>
	<style type="text/css">
	html,body{height:100%}
	.title{ width:250px; height: 10%; margin-top: 10px; margin-left:20px;}
	/*页面*/
	.main{background:#FFFFDD; width:95%;margin-top: 10px;margin-left:20px;margin-right: 20px;}
	.ScoreAdd{width: 660px;  background:#FFFFDD ;float: left;}
	.Descript{width:400px;height: 300px; background:#E3EEED;float: left;margin-left: 30px;margin-top: 15px;}

	.p1{margin-top:5px; margin-left: 2px;font-size: 16px;margin-bottom: 10px;float: left;}
	.p2{font-size:14px;background:#FFFFDD;margin-top: 3px;font-family:'微软雅黑';margin-top: 5px;}
	.p3{font-size:14px;background:#FFFFDD;margin-top: 5px}
	/*未考核 字段的标签*/
	.p4{font-size:14px;color:#77A7D9;background:#FFFFDD;margin-top: 3px;font-family:'微软雅黑';margin-top: 5px; }
	/*平均分*/
	.p7{font-size:14px;margin-top: 3px;font-family:'微软雅黑';margin-top: 5px; }
	/*通用类字体显示*/
	.p5{font-size:14px;background:#FFFFDD;margin-top: 3px;font-family:'微软雅黑';margin-top: 5px;}

	.p56{font-size:14px;background:#FFFFDD;margin-top: 3px;font-family:'微软雅黑';color:#F72B0A;margin-top: 5px }
	/*软件类字体显示*/
	.p6{font-size:14px;background:#FFFFDD;margin-top: 3px;font-family:'微软雅黑';margin-top: 5px;}

	/*通用类考核列表和分数标签*/
	.TY{background:#FFFFDD;width:250px;float: left;}
	.TY-score{background:#FFFFDD;width:90px;float: left;}
	.TY-scoreAverage{background:#FFFFDD;width:60px;float: left;}
	.TY-person{background:#FFFFDD;width:60px;float: left;margin-left: 20px;}
	.TY-time{background:#FFFFDD;width:120px;float: left;margin-left: 30px;}

	/*PA机械类考核列表和分数标签*/
	.ME{background:#FFFFDD;width:250px;float: left;}
	.ME-score{background:#FFFFDD;width:90px;float: left; }
	.ME-scoreAverage{background:#FFFFDD;width:60px;float: left;}
	.ME-person{background:#FFFFDD;width:60px;float: left;margin-left: 20px;}
	.ME-time{background:#FFFFDD;width:120px;float: left;margin-left: 30px;}

	/*PA软件类考核列表和分数标签*/
	.SW{background:#FFFFDD;width:250px;float: left;}
	.SW-score{background:#FFFFDD;width:90px;float: left; }
	.SW-scoreAverage{background:#FFFFDD;width:60px;float: left;}
	.SW-person{background:#FFFFDD;width:60px;float: left;margin-left: 20px;}
	.SW-time{background:#FFFFDD;width:120px;float: left;margin-left: 30px;}

	/*这是考核类别的标签*/
	.TYLabel{width:640px;background: #FFFFDD;margin-left: 10px;margin-top: 10px;}
	.MELabel{width:640px;background: #FFFFDD;margin-left: 10px;margin-top: 50px;}
	.SWLabel{width:640px;background: #FFFFDD;margin-left: 10px;margin-top: 50px;margin-bottom: 50px;}

	/*这是考核说明部分的样式*/
	.titleDS{width:100%; height: 40px; background: #E3EEED;}
	.titleDSP{position: absolute; margin-left: 10px;margin-top: 5px;background: #E3EEED;font-size: 15px;}
	.titleBody{width:100%; height: 90px; background: #E3EEED;}
	.titleBodyP1{position: absolute; margin-left: 10px;margin-top: 10px;background: #E3EEED;}
	.titleBodyP2{position: absolute; margin-left: 10px;margin-top: 40px;background: #E3EEED;}
	.titleBodyP3{position: absolute; margin-left: 10px;margin-top: 70px;background: #E3EEED;}
	.titleBodyP4{position: absolute; margin-left: 10px;margin-top: 100px;background: #E3EEED;}
	.titleBodyP5{position: absolute; margin-left: 10px;margin-top: 130px;background: #E3EEED;}
	.titleBodyP2P{position: absolute; margin-left: 200px;margin-top: 40px;background: #E3EEED;}
	.titleBodyP3P{position: absolute; margin-left: 200px;margin-top: 70px;background: #E3EEED;}
	.titleBodyP4P{position: absolute; margin-left: 200px;margin-top: 100px;background: #E3EEED;}
	.titleBodyP5P{position: absolute; margin-left: 200px;margin-top: 130px;background: #E3EEED;}

	.layui-btn1{margin-top: 10px;margin-left: 45px;width: 100px; height: 30px;}
	.selectID{font-size:13px;height: 30px;width: 150px;margin-top: 1px;margin-left: 10px;}

	</style>
</head>

<body>

<form class="layui-form1" method="post" action="ResultConnect.php">
	<div class ="title">
		<h1 class="p1">请选择查询人员</h1>
		      <select name="name" type="text" class="selectID" onchange="submit();">
		    		<option value="">
						请选择查询人员
					</option>

						<?php
							//从数据库personal中提取人名
							$sttName = find_one_all('personal_msg',$db,'Name_Index>0','Name'); 
						?>

						<?php  
				        	//获取长度
				       		$arrlength1=count($sttName[0]);   
				       		//循环获取人员信息 	
				        	for ($i=0; $i<=$arrlength1-1; $i++){
				        ?><option value="<?php echo $sttName[0][$i]['Name'];?>"><?php echo $sttName[0][$i]['Name'];?></option>
				        <?php 
				           }
				      	?>			
		      </select>
	</div>
</form>

<script type="text/javascript">
	var op=document.getElementsByTagName('option');
          var n=op.length;
          for(var i =0;i<n;i++){
            if (op[i].value==<?php echo "'".$_POST['name']."'";?>) {
                op[i].selected=true;
            }
          }


</script>


	<!-- 主页面 -->
	<div id="main" class ="main">

		<div class="ScoreAdd">
			<!-- 通用类 -->
			<div id="TYLabel" class="TYLabel">
				<div id="TY" class="TY">
					<h1 class="p2">--通用类</h1>
					<?php 
						//从数据库 category_msg_content 中提取考核的内容，本函数查询通用类；
						$sttName = find_one_all('category_msg_content',$db,'Category_Index=1','connent');  
			        	//获取长度
			       		$arrlength=count($sttName[0]);   
			       		//循环获取人员信息 	
			        	for ($i=0; $i<=$arrlength-1; $i++){
					?>
					<h2 class="p2"><?php echo "&nbsp;&nbsp;&nbsp;";echo "•";echo $sttName[0][$i]['connent'];?></h2>
					<?php 
						}
					?>	
				</div>

				<!-- 通用类考核分数 -->
		 		<div class="TY-score">
					<h1 class="p5">--分数</h1>
					<!--01 电气模块 -->
					<?php 
						$str2 = '电气模块';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$TYS += max($Scor);
								

							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--02 机械模块 -->
					<?php 
						$str2 = '机械模块';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$TYS += max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>


					<!--03 通用PLC -->
					<?php 
						
						$str2 = '通用PLC';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 	
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$TYS += max($Scor);
								
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>


					<!--04 图纸 -->
					<?php 
						$str2 = '图纸';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 	
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$TYS += max($Scor);
							
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>


					<!--05 万用表 -->
					<?php 
						
						$str2 = '万用表';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 	
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$TYS += max($Scor);
							
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>


					<!--06 相机 -->
					<?php 			
						$str2 = '相机';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						   ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 	
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$TYS += max($Scor);
								
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
				</div>
				
				<!-- 通用类考核平均分数 -->
				<div class="TY-scoreAverage">
					<h1 class="p5">--平均分</h1>

					<!-- 电气模块平均分 -->
					<?php
					$str3 = '电气模块';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						$TYSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!-- 机械模块平均分 -->
					<?php
					$str3 = '机械模块';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$TYSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!-- 通用PLC平均分 -->
					<?php
					$str3 = '通用PLC';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$TYSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>


					<!-- 图纸平均分 -->
					<?php
					$str3 = '图纸';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$TYSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>


					<!-- 万用表平均分 -->
					<?php
					$str3 = '万用表';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$TYSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!-- 相机平均分 -->
					<?php
					$str3 = '相机';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$TYSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>
				</div>

				<!-- 考核人 -->
				<div class="TY-person">
					<h1 class="p5">--考核人</h1>
					<!--01 电气模块 -->
					<?php 
						$str2 = '电气模块';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--02 机械模块 -->
					<?php 
						$str2 = '机械模块';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--03 通用PLC -->
					<?php 
						$str2 = '通用PLC';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--04 图纸 -->
					<?php 
						$str2 = '图纸';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--05 万用表 -->
					<?php 
						$str2 = '万用表';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--06 相机 -->
					<?php 
						$str2 = '相机';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>
				</div>
					
				<!-- 考核时间 -->
				<div class="TY-time">
					<h1 class="p5">--考核时间</h1>
					<!--01 电气模块 -->
					<?php 
						$str2 = '电气模块';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--02 机械模块 -->
					<?php 
						$str2 = '机械模块';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--03 通用PLC -->
					<?php 
						$str2 = '通用PLC';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--04 图纸 -->
					<?php 
						$str2 = '图纸';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--05 万用表 -->
					<?php 
						$str2 = '万用表';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--06 相机 -->
					<?php 
						$str2 = '相机';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

				</div>
					
			</div>
		
			<!-- PA机械类 -->
			<div id="MELabel" class="MELabel">
				<div id="ME" class="ME">
					<h1 class="p2">--PA机械类</h1>
					<?php 
						//从数据库 category_msg_content 中提取考核的内容，本函数查询通用类；
						$sttName = find_one_all('category_msg_content',$db,'Category_Index=2','connent');  
			        	//获取长度
			       		$arrlength=count($sttName[0]);   
			       		//循环获取人员信息 	
			        	for ($i=0; $i<=$arrlength-1; $i++){
					?>
					<h2 class="p2"><?php echo "&nbsp;&nbsp;&nbsp;";echo "•";echo $sttName[0][$i]['connent'];?></h2>
					<?php 
						}
					?>	
				</div>

				<div class="ME-score">
					<h1 class="p2">--分数</h1>
					<!--01 AH机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'AH机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								$MESA+=round($AverageScore,2);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--02 AH机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'AH机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) 
						{
						   ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}
						else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
						
						

					<!--03 AH机器人三轴张紧机构拆装 -->
					<?php 
						//$str1 = '郭志坚';
						$str2 = 'AH机器人三轴张紧机构拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--04 AH机器人丝杆组件拆装 -->
					<?php 
						//$str1 = '郭志坚';
						$str2 = 'AH机器人丝杆组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--05 AH机器人硬件维护操作 -->
					<?php 
						//$str1 = '郭志坚';
						$str2 = 'AH机器人硬件维护操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--06 AP机器人PA卡组件拆装 -->
					<?php 
						//$str1 = '郭志坚';
						$str2 = 'AP机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<?php 
						$str2 = 'AP机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) 
						{
						   ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}
						else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--07 AP机器人硬件维护操作 -->
					<?php 
						//$str1 = '郭志坚';
						$str2 = 'AP机器人硬件维护操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						

						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
						
					<!--08 HS机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'HS机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						

						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
						
					<!--09 HS机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'HS机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						

						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
							
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--10 HS机器人丝杆组件拆装 -->
					<?php 
						$str2 = 'HS机器人丝杆组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						

						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					

					<!--11 HS机器人硬件维护操作考核 -->
					<?php 
						$str2 = 'HS机器人硬件维护操作考核';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						

						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$MES+=max($Scor);
								
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
				</div>

				<!-- PA机械类考核平均分数 -->
				<div class="ME-scoreAverage">
					<h1 class="p5">--平均分</h1>
					<!-- 1 AH机器人PA卡组件拆装 -->
					<?php
					$str3 = 'AH机器人PA卡组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>


					<!-- 2 AH机器人电机减速机组件拆装 -->
					<?php
					$str3 = 'AH机器人电机减速机组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!-- 3 AH机器人三轴张紧机构拆装 -->
					<?php
					$str3 = 'AH机器人三轴张紧机构拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!-- 4 AH机器人丝杆组件拆装 -->
					<?php
					$str3 = 'AH机器人丝杆组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--5 AH机器人硬件维护操作 -->
					<?php
					$str3 = 'AH机器人硬件维护操作';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--6 AP机器人PA卡组件拆装 -->
					<?php
					$str3 = 'AP机器人PA卡组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!-- 7 AP机器人硬件维护操作 -->
					<?php
					$str3 = 'AP机器人硬件维护操作';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--8 HS机器人PA卡组件拆装 -->
					<?php
					$str3 = 'HS机器人PA卡组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--9 HS机器人电机减速机组件拆装 -->
					<?php
					$str3 = 'HS机器人电机减速机组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--10 HS机器人丝杆组件拆装 -->
					<?php
					$str3 = 'HS机器人丝杆组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--11 HS机器人硬件维护操作考核 -->
					<?php
					$str3 = 'HS机器人硬件维护操作考核';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!-- 2 AP机器人电机减速机组件拆装 -->
					<?php
					$str3 = 'AP机器人电机减速机组件拆装';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$MESA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>
				</div>	

				<!-- 考核人 -->
				<div class="ME-person">
					<h1 class="p5">--考核人</h1>
					<!--01 AH机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'AH机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--02 AH机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'AH机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--03 AH机器人三轴张紧机构拆装 -->
					<?php 
						$str2 = 'AH机器人三轴张紧机构拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>


					<!--04 AH机器人丝杆组件拆装 -->
					<?php 
						$str2 = 'AH机器人丝杆组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--05 AH机器人硬件维护操作 -->
					<?php 
						$str2 = 'AH机器人硬件维护操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--06 AP机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'AP机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--07 AP机器人硬件维护操作 -->
					<?php 
						$str2 = 'AP机器人硬件维护操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--08 HS机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'HS机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--09 HS机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'HS机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--10 HS机器人丝杆组件拆装 -->
					<?php 
						$str2 = 'HS机器人丝杆组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--11 HS机器人硬件维护操作考核 -->
					<?php 
						$str2 = 'HS机器人硬件维护操作考核';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--02 AP机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'AP机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>
				</div>

				<!-- 考核时间 -->
				<div class="ME-time">
					<h1 class="p5">--考核时间</h1>
					<!--01 AH机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'AH机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--02 AH机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'AH机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--03 AH机器人三轴张紧机构拆装 -->
					<?php 
						$str2 = 'AH机器人三轴张紧机构拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--04 AH机器人丝杆组件拆装 -->
					<?php 
						$str2 = 'AH机器人丝杆组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--05 AH机器人硬件维护操作 -->
					<?php 
						$str2 = 'AH机器人硬件维护操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--06 AP机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'AP机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--07 AP机器人硬件维护操作 -->
					<?php 
						$str2 = 'AP机器人硬件维护操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--08 HS机器人PA卡组件拆装 -->
					<?php 
						$str2 = 'HS机器人PA卡组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--9 HS机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'HS机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--10 HS机器人丝杆组件拆装 -->
					<?php 
						$str2 = 'HS机器人丝杆组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--11 HS机器人硬件维护操作考核 -->
					<?php 
						$str2 = 'HS机器人硬件维护操作考核';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--11 AP机器人电机减速机组件拆装 -->
					<?php 
						$str2 = 'AP机器人电机减速机组件拆装';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

				</div>
			</div>

			<!-- PA软件类 -->
			<div id="SWLabel" class="SWLabel">
				<div id="SW" class="SW">
					<h1 class="p2">--PA软件类</h1>
					<?php 
						//从数据库 category_msg_content 中提取考核的内容，本函数查询通用类；
						$sttName = find_one_all('category_msg_content',$db,'Category_Index=3','connent');  
			        	//获取长度
			       		$arrlength=count($sttName[0]);   
			       		//循环获取人员信息 	
			        	for ($i=0; $i<=$arrlength-1; $i++){
					?>
					<h2 class="p2"><?php echo "&nbsp;&nbsp;&nbsp;";echo "•";echo $sttName[0][$i]['connent'];?></h2>
					<?php 
						}
					?>	
				</div>

				<div class="SW-score">
					<h1 class="p2">--分数</h1>

					<!--01 PV基本使用 -->
					<?php 
						$str2 = 'PV基本使用';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>


					<!--02 PV视觉应用开发 -->
					<?php 
						$str2 = 'PV视觉应用开发';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--03 多工具动态分拣 -->
					<?php 
						$str2 = '多工具动态分拣';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--04 高精度纠偏 -->
					<?php 
						$str2 = '高精度纠偏';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--05 机器人基本操作 -->
					<?php 
						$str2 = '机器人基本操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
					<!--06 三菱PLC -->
					<?php 
						$str2 = '三菱PLC';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>


					<!--07 手眼相机 -->
					<?php 
						$str2 = '手眼相机';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>

					<!--08 威纶触摸屏 -->
					<?php 
						$str2 = '威纶触摸屏';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
					<!--09 硬件IO应用开发 -->
					<?php 
						$str2 = '硬件IO应用开发';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
					
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NScore ?></h2>
							<?php 
						}else
						{
							$arrlength=count($stt[0]);
							//判断这个人的考核测试，如果这个数值大于1，

							//新建一个存储成绩的数组
							$Scor=array();
							foreach($stt as $key => $value)
							{
								for($i=0; $i<=$arrlength-1; $i++)
								{	
									//将所有成绩进行存储
									$Scor[] =$value[$i]['Grade'];
								} 
							}	
							//**************再获取这个模块的平均分******************
						
							$name1 = 'Content='."'$str2'";
							$stt =find_ID_name('common_grade',$db,$name1);

							if (count($stt)==0) {
							    
							}else{
								$arrlength=count($stt[0]);
								//新建一个存储各个分数的数组
								$Scor1=array();
								foreach($stt as $key => $value)
								{
									for($i=0; $i<=$arrlength-1; $i++)
									{	
										//将所有成绩进行存储
										$Scor1[] =$value[$i]['Grade'];
									} 
								}
								// 以下是对成绩进行求取平均分
								$num = count($Scor1);			// 获取考核所有成绩的次数
								$Sun = array_sum($Scor1);		// 获取考核总分数
								$AverageScore = $Sun / $num;    // 计算平均分
								round($AverageScore,2);					// 并保留2位有效数字
								$NumConnnet+=1;
								$SWS+=max($Scor);
							}
							if(max($Scor) < round($AverageScore,2) ){
							?> 
								<h2 class="p56"><?php echo max($Scor); ?></h2>
							<?php
							}
							else
							{
							?>
								<!-- 提取出最高分进行显示 -->
								<h2 class="p5"><?php echo max($Scor); ?></h2>
							<?php
							}
							?>

							
						<?php
						}
					?>
				</div>

				<!-- PA软件类考核平均分数 -->
				<div class="SW-scoreAverage">
					<h1 class="p5">--平均分</h1>
					<!--1 PV基本使用 -->
					<?php
					$str3 = 'PV基本使用';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$SWSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--2 PV视觉应用开发 -->
					<?php
					$str3 = 'PV视觉应用开发';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$SWSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--3 多工具动态分拣 -->
					<?php
					$str3 = '多工具动态分拣';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$SWSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--4 高精度纠偏 -->
					<?php
					$str3 = '高精度纠偏';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2)					// 并保留2位有效数字
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--5 机器人基本操作 -->
					<?php
					$str3 = '机器人基本操作';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$SWSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--6 三菱PLC -->
					<?php
					$str3 = '三菱PLC';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2)					// 并保留2位有效数字
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--7 手眼相机 -->
					<?php
					$str3 = '手眼相机';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$SWSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--8 威纶触摸屏 -->
					<?php
					$str3 = '威纶触摸屏';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$SWSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>

					<!--9 硬件IO应用开发 -->
					<?php
					$str3 = '硬件IO应用开发';
					// 选择需要查看的内容
					$name1 = 'Content='."'$str3'";
					$stt =find_ID_name('common_grade',$db,$name1);
					if (count($stt)==0) {
					    ?>
						<h2 class="p7"><?php echo '0' ?></h2>
						<?php 
					}else
					{
						$arrlength=count($stt[0]);
						//新建一个存储各个分数的数组
						$Scor=array();
						foreach($stt as $key => $value)
						{
							for($i=0; $i<=$arrlength-1; $i++)
							{	
								//将所有成绩进行存储
								$Scor[] =$value[$i]['Grade'];
							} 
						}
						// 以下是对成绩进行求取平均分
						$num = count($Scor);			// 获取考核所有成绩的次数
						$Sun = array_sum($Scor);		// 获取考核总分数
						$AverageScore = $Sun / $num;    // 计算平均分
						round($num,2);					// 并保留2位有效数字
						$SWSA +=round($AverageScore,2);
					?>
						<!-- 提取出最高分进行显示 -->
						<h2 class="p5"><?php echo round($AverageScore,2); ?></h2>
					<?php
					}
					?>
				</div>


				<!-- 考核人 -->
				<div class="SW-person">
					<h1 class="p5">--考核人</h1>
					<!--01 PV基本使用 -->
					<?php 
						$str2 = 'PV基本使用';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--02 PV视觉应用开发 -->
					<?php 
						$str2 = 'PV视觉应用开发';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--03 多工具动态分拣 -->
					<?php 
						$str2 = '多工具动态分拣';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--04 高精度纠偏 -->
					<?php 
						$str2 = '高精度纠偏';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--05 机器人基本操作 -->
					<?php 
						$str2 = '机器人基本操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--06 三菱PLC -->
					<?php 
						$str2 = '三菱PLC';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--07 手眼相机 -->
					<?php 
						$str2 = '手眼相机';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--08 威纶触摸屏 -->
					<?php 
						$str2 = '威纶触摸屏';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>

					<!--09 硬件IO应用开发 -->
					<?php 
						$str2 = '硬件IO应用开发';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['people'];?></h2>
					<?php 	
						} }	}
					?>
				</div>
					
				<!-- 考核时间 -->
				<div class="SW-time">
					<h1 class="p5">--考核时间</h1>
					<!--01 PV基本使用 -->
					<?php 
						$str2 = 'PV基本使用';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--02 PV视觉应用开发 -->
					<?php 
						$str2 = 'PV视觉应用开发';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--03 多工具动态分拣 -->
					<?php 
						$str2 = '多工具动态分拣';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--04 高精度纠偏 -->
					<?php 
						$str2 = '高精度纠偏';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--05 机器人基本操作 -->
					<?php 
						$str2 = '机器人基本操作';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--06 三菱PLC -->
					<?php 
						$str2 = '三菱PLC';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--07 手眼相机 -->
					<?php 
						$str2 = '手眼相机';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--08 威纶触摸屏 -->
					<?php 
						$str2 = '威纶触摸屏';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>

					<!--09 硬件IO应用开发 -->
					<?php 
						$str2 = '硬件IO应用开发';
						$name1 = 'Name='."'$str1' and Content='$str2' ";
						$stt =find_ID_name('common_grade',$db,$name1);
						//判断成绩数组是否为null,如果没有考核记录，默认成绩为“0”分
						if (count($stt)==0) {
						    ?>
							<h2 class="p4"><?php echo $NPeople ?></h2>
							<?php 
						}else{
							//取考核的第一个人
							$arrlength=1;
							foreach($stt as $key => $value){
							for($i=0; $i<=$arrlength-1; $i++){	
							?>
							<h2 class="p5"><?php echo $value[$i]['Date'];?></h2>
					<?php 	
						} }	}
					?>
				</div>

			</div>

		</div>
	

	<div class="Descript">
		<div class="titleDS">
			<p class="titleDSP">说明</p>
		</div>

		<div class="titleBody">
			<p class="titleBodyP1">考核总共 27 项，目前共考核<?php echo "&nbsp";echo $NumConnnet;echo "&nbsp";?>项。还剩<?php echo "&nbsp"; echo 27-$NumConnnet ;echo "&nbsp";?>项未考核</p>

			
			<p class="titleBodyP2">总成绩：<?php echo $TYS+$MES+$SWS ?></p>
			<p class="titleBodyP2P">平均总成绩：<?php echo $TYSA+$MESA+$SWSA ?></p>
			
		
			<p class="titleBodyP3">PA通用类考核总分：<?php echo $TYS; ?></p>
			<p class="titleBodyP3P">PA通用类总平均总分：<?php echo $TYSA; ?></p>

			<p class="titleBodyP4">PA机械类考核总分：<?php echo $MES; ?></p>
			<p class="titleBodyP4P">PA机械类总平均总分：<?php echo $MESA; ?></p>

			<p class="titleBodyP5">PA软件类考核总分：<?php echo $SWS; ?></p>
			<p class="titleBodyP5P">PA软件类总平均总分：<?php echo $SWSA; ?></p>

		</div>

		<div class="titlecont">
			
		</div>
	</div>
		
	</div>

<script>
		layui.use(['layer'], function(){
		  var element = layui.element;
		  var layer = layui.layer;
		});

	    layui.use('table', function(){
	        var table = layui.table;
	      
	    });

		document.getElementById('TYLabel').style.height=document.getElementById('TY').offsetHeight+"px";
		document.getElementById('MELabel').style.height=document.getElementById('ME').offsetHeight+"px";
		document.getElementById('SWLabel').style.height=document.getElementById('SW').offsetHeight+"px";
		
	    

</script>

</body>


</html>