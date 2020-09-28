<?php
require  'function.php';            //引入数据库接口函数
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>excel</title>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css">
	<script type="text/javascript" src="layui/layui.js"></script>
  <script type="text/javascript" src="excel.js"></script>
	<style type="text/css">
	.operation{height: 100px;width: 100%;background: #FFFFDD; margin-top: 50px;}
	.log{width: 100%;background: #FFFFDD; margin-top: 50px;}
	.p1{margin-left: 30px;font-size: 20px}
	.p2{font-size: 15px;margin-left: 30px}
	.layui-upload{margin-left: 30px;margin-top: 20px;}
	.lab{margin-left: 30px;margin-top: 10px;}
  img
    {
      text-align: center;
      width: 900px;
      height: 250px;
      
    }
	</style>
</head>

<body>

	<div class="operation">
		<h1 class="p1">请管理员录入Excel标准考核文档</h1>

		<div class="layui-upload">
		  <button type="button" class="layui-btn" id="LAY-excel-upload">
                            <i class="layui-icon"></i>上传文档
      </button><input class="layui-upload-file" type="file" accept="undefined" name="file">
		</div>
	</div>


	<div class="log">

		<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  			<legend>上传记录</legend>
		</fieldset> 
			<ul class="layui-timeline">
				<?php
                        //从数据库中提取类别
                        $find  =  find_ID_All('upload_log',$db);    //从数据表upload_log中获取上传记录的数据     
                                $arrlength=count($find[0]);        
                                for  ($i=$arrlength-1;  $i >=0;  $i--){
                            ?>
                                <li class="layui-timeline-item">
							    <i class="layui-icon layui-timeline-axis"></i>
							    <div class="layui-timeline-content layui-text">
							      <div class="layui-timeline-title"><?php echo $find[0][$i]['upload_date'].' '.$find[0][$i]['uploader'].' ';?>上传一次考核记录</div>
							    </div>
							  </li>
                            <?php  
                                  }
                            ?>

			</ul>
			<br><br>
	</div>

<script type="text/javascript">
   layui.use(['jquery', 'layer', 'upload', 'excel', 'laytpl', 'element', 'code'], function () {
  var $ = layui.jquery;
  var layer = layui.layer;
  var upload = layui.upload;
  var excel = layui.excel;
  var laytpl = layui.laytpl;
  var element = layui.element;




  //upload上传实例
  var uploadInst = upload.render({
    elem: '#LAY-excel-upload' //绑定元素
    , url:'' //上传接口
    , auto: false //选择文件后不自动上传
    , accept: 'file'//设置上传文件类型，可设置为video（视频）,image（图片）,audio（音频）,file（所有文件）
    , exts:'xlsx'//允许上传的文件后缀，格式为'xlsx/xls'
    , choose: function (obj) {// 选择文件回调
      var files = obj.pushFile()
      var fileArr = Object.values(files)// 注意这里的数据需要是数组，所以需要转换一下

      // 用完就清理掉，避免多次选中相同文件时出现问题
      for (var index in files) {
        if (files.hasOwnProperty(index)) {
          delete files[index]
        }
      }
      $('#LAY-excel-upload').next().val('');

      uploadExcel(fileArr)
    }
  });

  $(function () {
    // 监听上传文件的事件
    $('#LAY-excel-import-excel').change(function (e) {
      // 注意：这里直接引用 e.target.files 会导致 FileList 对象在读取之前变化，导致无法弹出文件
      var files = Object.values(e.target.files)
      uploadExcel(files)
      // 变更完清空，否则选择同一个文件不触发此事件
      e.target.value = ''
    })
    // 文件拖拽
    document.body.ondragover = function (e) {
      e.preventDefault()
    }
    document.body.ondrop = function (e) {
      e.preventDefault()
      var files = e.dataTransfer.files
      uploadExcel(files)
    }
    // 2019-08-17 页面直接展示所有demo
    renderDemoList()

  })
})

function uploadExcel(files) {
  layui.use(['excel', 'layer'], function () {
    var excel = layui.excel
    var layer = layui.layer
    try {
      excel.importExcel(files, {
        // 读取数据的同时梳理数据
        fields: {
            'Name': 'A'
          , 'Category': 'B'
          , 'Content': 'C'
          , 'people': 'D'
          , 'Date': 'E'
          , 'Grade': 'F'
          
        }
      }, function (data) {
        var index = layer.load(0, {
          shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        var x=data[0].Sheet1;     //获取excel表格中的对象
        for (var i = 1; i < data[0].Sheet1.length; i++) {   //由于excel中的日期是通过数字值来表示的，因此需要转化成 年/月/日 格式
        	var date=LAY_EXCEL.dateCodeToDate(x[i]['Date']);     //通过layui内置函数，将excel日期数值转化成js的日期对象
	        var year=date.getFullYear();     //获取年、月、日
	        var month=date.getMonth()+1;
	        var day=date.getDate();
	        x[i]['Date']=year+'/'+month+'/'+day;
        }

        $.ajax({      //通过ajax将 x 传给ExcelforPHP页面
            type: "post",
            async: true,
            url: "ExcelforPHP.php",
            data: {y:x},
            dataType: "text",     //从ExcelforPHP返回的类型
            success: function(result){                           	
                    layer.confirm(result, {
				        icon:1,
				        btn: ['确定' ]
				    }, function(){
                layer.close(index);
				        location.reload();//当请求已完成时，刷新本页面
				    });
			                
            },
            error: function(XMLHttpRequest, errMsg, errThrown) {
                alert(XMLHttpRequest.status+','+XMLHttpRequest.readyState+','+errMsg);            
            }
        });       
      })
    } catch (e) {
      layer.alert(e.message)
    }
  })
}    

</script>
</body>


</html>