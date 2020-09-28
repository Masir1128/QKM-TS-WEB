<?php
//设置页面html编码字符集
require 'function.php';
$data = array();
class User{
    public $username;
    public $age;
}
$aa = $_GET['data'];
// $aa='三菱PLC';

// $sql = "SELECT common_id, Content, Grade FROM common_grade WHERE Name ='$aa'" ;
       $data=array();
        $result =find_ID_name('common_grade',$db,'Content="'.$aa.'"');       
        $arrlength=count($result[0]); 
        if ($arrlength>0) {
          for($i=0; $i<$arrlength; $i++){
               for ($j=0; $j <count($data); $j++) { 
                    if ($result[0][$i]['Name']==$data[$j]->username) {
                        if ($result[0][$i]['Grade']>$data[$j]->age) {
                             array_splice($data, $j, 1);
                             break;
                        }
                        else{
                            continue 2;
                        }
                    }
                        
                }
                $user = new User();
                $user->username = $result[0][$i]['Name'];
                $user->age = $result[0][$i]['Grade'];
                $data[] = $user;            
            }
        } 

echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>