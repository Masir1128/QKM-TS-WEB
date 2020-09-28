<!-- 
说明：该模块是新增考核记录的模块；
开发时间：7/22/2020
开发人：Masir
版本：测试版V1.1
 -->

 <?php
require  'function.php'; //连接数据库
$KHname=$_POST['KHname'];
$type=$_POST['type'];
$content=$_POST['content'];
$JKname=$_POST['JKname'];
$time=$_POST['time'];
$score=$_POST['score'];

if ($KHname == ""||$type == ""||$content == ""||$JKname == ""||$time == "" ||$score == ""){
		// 通过网页形式显示
		echo "<script language=\"JavaScript\">alert(\"请输出完整的数据\");history.back();</script>";
	}else{
		if (!is_numeric($score)||$score<0||$score>100) {
		echo "<script language=\"JavaScript\">alert(\"请输入0~100之间的分数\");history.back();</script>";
		}
		else{
			$sql = "INSERT INTO `common_grade` (`common_id`,`Name`,`Category`,`Content`,`people`,`Date`,`Grade`) VALUES ('','$KHname','$type','$content','$JKname','$time','$score')";
			$stt =insert($db,$sql);
			//print_r('插入成功 ' .$stt);
			// 通过网页形式显示
			echo "<script language=\"JavaScript\">alert(\"插入成功\");history.back();</script>";
		}
	}


	

?>
