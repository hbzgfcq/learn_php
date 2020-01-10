<?php
	$examID = $_GET['examID'];
	$userID = $_SESSION['user']['userID'];
	$sql="select * from v_exams where examID='{$examID}' and testbuilder = '{$userID}'";
	if(!($exam = $db->getRow($sql)))
	{
		$db->db_err('你非本次考试的制卷人无权操作');
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $app_name?></title>
	<script language="javascript" type="text/javascript" src="/js/jquery-1.7.2.js"></script>
	<script language="javascript" type="text/javascript" src="/js/functions.js"></script>
	<link href="/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<style>
		body,.g-ft{background:#ccc;}
		.g-doc{background:#fff;position:relative;}
		.g-hd-1{padding:12px 0px 12px 8px;background:#eee;font-weight:bold;color:#303030;}
		.g-ft{height:150px;line-height:150px;}
		a.btn-1{ display:block; height:29px; line-height:29px; text-align:center; background:#ccc; color:#fff; }
		a.btn-1:hover{background:#cc0000;}
		.m-qs{
		}
		.q{
			margin:0px 0px 8px 0px;
			padding:8px;
			background:#3c3c3c;
			color:#fff;
			font-weight:bold;
		}
		.qb,.qa,.qc{
			margin-bottom:10px;			
		}
		.qb{
		}
		.qa{
			color:#FF7F50;
		}
		.qo a{
			color:#9370DB;
		}
		.qa *{
			margin-right:5px;
		}
		.qa textarea,.qc textarea{
			padding:4px;
			width:500px;
			height:100px;
		}
	</style>
</head>
<body>
<div class="g-doc">
	<input type="hidden" id="pageName" name="pageName" value="<?php echo $p?>" />
	<div class="g-hd-1">
		<?php echo $exam['yyyy'].'级'.$exam['majoyName'].'专业'.'学期'.$exam['term'].$exam['courseName'].$exam['examType'].'考试';?> —— 试 卷
		<a href="index.php?p=ksgl" style="color:blue;">&nbsp;&nbsp;&nbsp;主页</a>
	</div>
	<!--doc body-->
	<div class="g-md">
		<div class="g-qbar" style="padding-left:0px;">
			<table class="tb-qbar">
				<tr>
					<input type="hidden" name="examID" value="<?php echo $examID;?>"/>
					<input type="hidden" name="qType" />
					<td><a href="javascript:void(0);" class="btn-1 query" id="query1" style="width:80px;">单选</a></td>
					<td><a href="javascript:void(0);" class="btn-1 query" id="query2" style="width:80px;">多选</a></td>
					<td><a href="javascript:void(0);" class="btn-1 query" id="query3" style="width:80px;">判断</a></td>
					<td><a href="javascript:void(0);" class="btn-1 query" id="query4" style="width:80px;">填空</a></td>
					<td><a href="javascript:void(0);" class="btn-1 query" id="query5" style="width:80px;">问答</a></td>
					<td><a href="javascript:void(0);" class="btn-1" id="delPaper" style="width:80px;">删除</a></td>
				</tr>
			</table>
		</div>
		<div class="g-content">
			<div class="m-qs">
			</div>
		</div>
	</div>
	<div class="g-ft">
		<b>Copyright © 2015 Orange.com All Rights Reserved</b>
	</div>
</div>
<!--js-->
<script>
$(document).ready(function(){
	var examID = $(".tb-qbar :input[name='examID']").val();
	var div_qs = $(".m-qs");
	$(".query").click(function(){
		$(".query").css('background','');
		$(this).css('background','#cc0000');
		$(".tb-qbar :input[name='qType']").val($(this).text());
		
		var qType = encodeURIComponent($.trim($(".tb-qbar :input[name='qType']").val()));
		var strUrl = "index.php?p=sjgl.check.ajax&a=R&examID="+examID+"&qType="+qType+"&pageNo=0&pageSize=10000&r="+Math.random();
		$.ajax({
			url:strUrl,
			type:'get',
			datatype:'json',
			success:function(data){
				try
				{
					if(data=='') throw new Error("没有检索到数据");
					var data = eval(data);
					var sumRows = data.shift()['sumRows']; // 记录的总行数
					var rows = data;
				}
				catch (err)
				{	
					div_qs.empty();// 清空容纳题目的DIV
					alert('没有该类型的题目');
					return;
				}
				div_qs.empty();// 清空容纳题目的DIV
				for(var i = 0; i < rows.length;i++)
				{
					var q = rows[i];
					var qBox = $("<div></div>").addClass('q');
					qBox.append($("<div></div>").addClass('qo').text(q['fenshu']+'分'));
					qBox.append($("<div></div>").addClass('qb').html(q['question']));
					qBox.append($("<div></div>").addClass('qa').text(q['answer']));
					div_qs.append(qBox);
				}
			},
			error:function(){
				alert('访问数据库失败');
			}
		});
	});

	$("#delPaper").click(function(){
		if(confirm('你确信要删除本次考试的试卷吗？'))
		{
			var sendData = "examID="+examID;
			strUrl = "index.php?p=sjgl.check.ajax&a=D&r=" + Math.random();
			$.ajax({
				url:strUrl,
				data:sendData,
				type:"get",
				datatype:"text",
				success:function(data){
					if(data==''){ // 没有返回数据表示真的成功了
						data="删除试卷成功";
					}
					alert(data);
				},
				error:function(){
					alert("删除试卷失败");
				}
			});	
		}
	});
});
</script>
</body>
</html>