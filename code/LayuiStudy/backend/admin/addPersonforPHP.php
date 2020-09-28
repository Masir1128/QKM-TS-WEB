<!-- 
说明：该模块是新增人员信息模块；
开发时间：7/22/2020
开发人：Masir
版本：测试版V1.1
 -->


<?php
require  'function.php'; //连接数据库
$name=$_POST['name'];
$gonghao=$_POST['gonghao'];
$zhiwei=$_POST['zhiwei'];
$bumen=$_POST['bumen'];
/*echo($name); 
echo "<br>";
echo($gonghao);
echo "<br>";
echo($zhiwei);
echo "<br>";
echo($bumen);*/

	if ($name == "" ||  $gonghao == ""  || $zhiwei == "" ||  $bumen == ""  ){
		// 通过网页形式显示
		echo "<script language=\"JavaScript\">alert(\"请输出完整的数据\");history.back();</script>";
	}else{
		$check = findlogin('personal_msg',$db,'name="'.$name.'" and Job_Num='.$gonghao);//调用函数findlogin搜索数据库
        if (!empty($check)) {//检验输入的姓名和工号是否与数据库里的记录有重复
          echo "<script language=\"JavaScript\">alert(\"已存在该人员信息\");history.back();</script>";
      }
        else{
		$sql = "INSERT INTO `personal_msg` (`Name_Index`,`Name`,`Job_Num`,`Tittle`,`department`) VALUES ('','$name','$gonghao','$zhiwei','$bumen')";
		$stt =insert($db,$sql);
		//print_r('插入成功 ' .$stt);
		// 通过网页形式显示
		echo "<script language=\"JavaScript\">alert(\"插入成功\");history.back();</script>";
		// echo "<script>parent.layer.closeAll();parent.layer.alert('插入成功');</script>";
		}
	}

?>