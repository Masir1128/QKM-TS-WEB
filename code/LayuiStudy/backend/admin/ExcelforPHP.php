<?php
session_start();
require 'function.php';

// var_dump($_POST['y']);

// echo json_encode($_POST['y'],JSON_UNESCAPED_UNICODE);
if (!empty($_POST['y'])) {
for ($i=1; $i < count($_POST['y']); $i++) { 

	if (is_numeric($_POST['y'][$i]['Grade'])) {
		$Name=$_POST['y'][$i]['Name'];
		$Category=$_POST['y'][$i]['Category'];
		$Content=$_POST['y'][$i]['Content'];
		$people=$_POST['y'][$i]['people'];
		$Date=$_POST['y'][$i]['Date'];
		$Grade=$_POST['y'][$i]['Grade'];
		$sql="INSERT INTO common_grade (`Name`,`Category`,`Content`,`people`,`Date`,`Grade`) 
	          VALUES ('$Name','$Category','$Content','$people','$Date','$Grade')";
	    insert($db,$sql);
	}
}
date_default_timezone_set("PRC");
$date=date('Y-m-d H:i:s');
$uploader=$_SESSION['username'];
$sql="INSERT INTO upload_log (upload_date,uploader) 
	  VALUES ('$date','$uploader')";
insert($db,$sql);
echo "上传成功！";
}

?>