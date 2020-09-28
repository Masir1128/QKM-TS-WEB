<?php
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
	.operation{height: 450px;width: 100%;background: #FFFFDD; margin-top: 100px;}
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


	<form id="form1" class="test" action="operationforPHP.php" method="post">
		<div class="operation">

			<label class="score">考核人员
				<!-- <input class="select" type="text" name="KHname" placeholder="请输入考核人姓名" onkeyup="this.value=this.value.replace(/ /g,'')"> -->
				<select id="form1_KHname" name="KHname" type="text" class="select" >
		    		<option value="">
						请选择
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
			</label><br>

			


			<label class="people">监考人员

				<select id="form1_JKname" class="select" name="JKname">
			      <option value="">请选择</option>
				  <option value="郭志坚">郭志坚</option>
				  <option value="钟智财">钟智财</option>
				  <option value="马扬">马扬</option>
				</select>
			</label><br>
				<input id="form1_type" type="text" name="type" value="" style="display: none;">
			</form>

			<form id="form2" action="" method="post">
				<input id="form2_KHname" type="text" name="KHname" value="" style="display: none;">
				<input id="form2_JKname" type="text" name="JKname" value="" style="display: none;">
				<input id="form2_score" type="text" name="score" value="" style="display: none;">
				<input id="form2_time" type="date" name="time" value="" style="display: none;">

			<label class="type">考核类别
			    <select id="form2_type" class="select" name="type"  onchange="goSubmit_form2()">
			      <option value="">请选择</option>
				  	<?php  
				  		$sttName = find_one_all('category_msg',$db,'Category_Index>0','Category_Name');  
			        	//获取数据库中人员信息
			       		$arrlength=count($sttName[0]);   
			       		//循环获取人员信息 	
			        	for ($i=0; $i<=$arrlength-1; $i++){
			        ?>
			        	<option value="<?php echo $sttName[0][$i]['Category_Name'];?>"><?php echo $sttName[0][$i]['Category_Name'];?></option>
			        <?php 
			           }
			      	?>
				</select>
			</label><br>

			</form>

			<label class="content">考核内容
			     <select id="form1_content" class="select" name="content" form="form1">
			      <option value="请选择">请选择</option>
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
			</label><br>

			



			<label class="score">考核分数
				<input id="form1_score" class="select" type="text" name="score" form="form1" autocomplete="off" placeholder="请输入考核分数" onkeyup="this.value=this.value.replace(/ /g,'')">
			</label><br>

			<label class="time">考核时间			
			        <input id="form1_time" class="select" type="date" name="time" form="form1" lay-verify="required|phone" autocomplete="off" class="layui-input" onkeyup="this.value=this.value.replace(/ /g,'')">	     
			</label><br>

			<button type="button" form="form1" class="layui-btn" onclick="goSubmit_form1()">记录</button>
			

		</div>

		<?php
			if (isset($_POST['type'])) {
				
      echo "<script>
      document.getElementById('form1_KHname').value='".$_POST['KHname']."';
      document.getElementById('form1_JKname').value='".$_POST['JKname']."';
      document.getElementById('form1_score').value='".$_POST['score']."';
      document.getElementById('form1_time').value='".$_POST['time']."';
      document.getElementById('form2_type').value='".$_POST['type']."';
      </script>";
    
			}
		?>


	<script type="text/javascript">
		function goSubmit_form2() {
			document.getElementById('form2_KHname').value=document.getElementById('form1_KHname').value;
			document.getElementById('form2_JKname').value=document.getElementById('form1_JKname').value;
			document.getElementById('form2_score').value=document.getElementById('form1_score').value;
			document.getElementById('form2_time').value=document.getElementById('form1_time').value;
		    document.getElementById('form2').submit();
		  }

		function goSubmit_form1() {
			document.getElementById('form1_type').value=document.getElementById('form2_type').value;
			document.getElementById('form1').submit();
			document.getElementById('form1_KHname').value='';
			document.getElementById('form1_JKname').value='';
			document.getElementById('form2_type').value='';
			document.getElementById('form1_content').value='';
			document.getElementById('form1_score').value='';
			document.getElementById('form1_time').value='';
			
		}



		function changeContent() {
			var xmlhttp= new XMLHttpRequest();//创建XMLHttprequest对象
			xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4&&xmlhttp.status==200) {
          
          
          
        }
      } 
	      xmlhttp.open("GET","operation.php?s="+x,true);//向add/del.php发送请求并传入表名和想要删除行的Name_Index
	      xmlhttp.send();
		}
	</script>
</body>


</html>