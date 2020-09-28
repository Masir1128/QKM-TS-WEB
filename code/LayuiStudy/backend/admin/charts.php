<?php
require  'function.php';            //引入数据库接口函数
?>

<!DOCTYPE  html>
<html>
<head>
<meta  charset="UTF-8">

<title>JQuery  Ajax  Test</title>
<script  src="echarts.min.js"></script>
<script  src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<style  type="text/css">
        html,body{height: 100%}
        .selectID{font-size:13px;height:  28px;width:  200px;margin-top:  1px;margin-left:  10px;}
        .title{float:left;width:100%;  margin-top:1px;height:  25%;margin-left:  15px;}
        .p1{margin-top:10px;font-size:15px;float:left;margin-left:  25px;}
</style>
</head>
<body>
        <form id="form1"  class="layui-form1"  method="post"  action="charts.php">
        <div  class  ="title">
                <h2  class="p1">类别
                <select  name="type"  type="text"  class="selectID"  onchange="goSubmit();"><!-- 选择完类别后调用goSubmit函数 -->
                    <option  value="">请选择</option>
                    <?php
                        //从数据库中提取类别
                        $sttName  =  find_one_all('category_msg',$db,'Category_Index>0','Category_Name');    
                    ?>
                    <?php   
                                $arrlength=count($sttName[0]);//获取数组长度      
                                //循环将类别写入option中   
                                for  ($i=0;  $i<=$arrlength-1;  $i++){
                            ?>
                                <option  value="<?php  echo  $sttName[0][$i]['Category_Name'];?>"><?php  echo  $sttName[0][$i]['Category_Name'];?></option>
                            <?php  
                                  }
                            ?>
                </select>
            </h2>

            <h2  class="p1">内容
                <select id="content"  name="content"  type="text"  class="selectID"  onchange="submit();">
                    <option  value="">请选择</option>
                    <?php
                        //根据类别从数据库中提取内容
                        $str  =  $_POST['type'];
                        $typename  =  'Category_Name='."'$str'";
                        $getTypeID  =find_ID_name('category_msg',$db,$typename);
                        $sttName  =  find_one_all('category_msg_content',$db,'Category_Index='.$getTypeID[0][0]['Category_Index'],'connent');    
                    ?>
                    <?php    
                                $arrlength3=count($sttName[0]);      
                                //循环将内容写入option中   
                                for  ($i=0;  $i<=$arrlength3-1;  $i++){
                            ?>
                                <option  value="<?php  echo  $sttName[0][$i]['connent'];?>"><?php  echo  $sttName[0][$i]['connent'];?></option>
                            <?php  
                                //$str  =  $sttName[0][$i]['Category_Name'];
                                  }
                            ?>
                </select>
            </h2>
        </div>
</form>
        <hr>
        <div  id="container"  style="width:  80%;  height:  80%;"></div>
        <div  id="error"  style="display:  none"><h3>暂无数据</h3></div>

        <?php
        if(empty($_POST['type'])||empty($_POST['content']))
        {
                //如果选择的类型或内容为空，则赋值为空
                $str1  =  '';
        ?>

        <?php
        }
        else
        {
                //print_r('提交姓名!!!');
           $content=$_POST['content'];         //用于传递combo 所提交的姓名
            $str1 = $content ;
    }
    ?>


    <?php       //每当选择类别或内容时都会提交一次表单并刷新页面，该部分则是防止页面刷新时把已选择的选项刷空
      if (isset($_POST['type'])||isset($_POST['content'])) {        //先判断是否提交了表单
        ?>
        <script type="text/javascript">
          var op=document.getElementsByTagName('option');       //获取选项数组
          var n=op.length;
          for(var i =0;i<n;i++){
            if (op[i].value==<?php echo "'".$_POST['type']."'";?>) {        //若有选项值与刷新前已选择的类型选项相同，则置为selected
                op[i].selected=true;
            }
            if (op[i].value==<?php echo "'".$_POST['content']."'";?>) {     //若有选项值与刷新前已选择的内容选项相同，则置为selected
                op[i].selected=true;
            }
            
          }
        </script>

        <?php
      }
      ?>


    <script>
        

    // 初始化两个数组，盛装从数据库中获取到的数据
    var names = [], ages = [];
    var aa = '<?php echo $str1 ?>';
    //调用ajax来实现异步的加载数据
    function getusers() {
        $.ajax({
            type: "post",
            async: false,
            url: "data.php?data="+aa,
            data: {},
            dataType: "json",
            success: function(result){

                if(result){
                    for(var i = 0 ; i < result.length; i++){
                        names.push(result[i].username);
                        ages.push(result[i].age);
                    }
                }
            },
            error: function(errmsg) {       
                // alert("Ajax获取服务器数据出错了！"+ errmsg);
                document.getElementById('error').style.display='block';     //将隐藏的div显示出来
                document.getElementById("container").style.display='none';      //将图表的容器div隐藏             
            }
        });
    return names, ages;
    }

    // 执行异步请求
    getusers();

        var sum=0;
        for(var i=0;i< ages.length;i++){
            sum+=ages.map(Number)[i];//将ages从字符串数组转化成数字数组加到sum中
        }
        var average=sum/ages.length;//计算成绩平均分

        // 初始化 图表对象
        var mychart = echarts.init(document.getElementById("container"));
        // 进行相关项的设置，也就是所谓的搭搭骨架，方便待会的ajax异步的数据填充
        var options = {
            title : {
                text : '成绩分布图'
            },
            tooltip : {
                show : true
            },
            legend : {
                data : [ '分数' ] 
            },
            grid: {  
            y2: 150  //增加柱形图纵向的高度
},
            xAxis : [ {
                data : names,   //获取异步读取的人名数据
                axisLabel:{  
                interval:0,//横轴信息全部显示  
                rotate:-65,//-15度角倾斜显示  
                },
            } ],
            yAxis : [ {
                type : 'value'
            } ],
            series : [{
                name : "分数",
                type : "bar",   // 设置样式
                barMaxWidth:100,
                data : ages,
                itemStyle:{
                    color:function(data){
                        var a=data.value;
                        if(a>=average){
                            return '#429E06';
                        }
                    }
                },
                label: {
                show: true,
                position: 'insideTop',
                fontSize: 18,
                },
                markLine : {
                    precision:1,
        　　　　　　 data : [{
                    type : 'average', 
        　　　　　　 name : '平均分',
        　　　　　　 lineStyle: {
                        color:"black",
                        width:2,
                    },
                    label: {
                        position: 'end',
                        formatter: '{b}: {c}',
                        fontSize:18,
                    }
    
        　　　　　　　}]
　　　　　　　　}
            }]
        };

        // 将配置项赋给chart对象，来显示相关的数据
        mychart.setOption(option);

        function goSubmit() {
            document.getElementById('content').value='';        //选择类别时，先将内容置空，再提交表单
            document.getElementById('form1').submit();      //提交表单
          }
    </script>
    
<marquee>数据分析，请选择相应的查询数据</marquee>

</body>
</html>