<?php
	$userID = $_SESSION['student'];
	$sql = "select * from v_students where userID = '{$userID}'";
	$student = $db->getRow($sql);
	
	$majoyID = $student['majoyID'];// 学生所属专业的ID
	$sql = "select * from v_exams where majoyID = '{$majoyID}' and examState='考试中' limit 1";// 该专业正在进行的考试
	if(!($exam = $db->getRow($sql)))
	{
		$db->db_err('你所在的专业现在没有考试');
	}
	$timeOfEnd = strtotime($exam['timeOfEnd']);
	if(time()>$timeOfEnd)
	{
		$db->db_err('考试时间已过，不能参加考试');
	}
	
	$qts = array('单选','多选','判断','填空','问答');
	$examID=$exam['examID'];
	for($i=0;$i<count($qts);$i++)
	{
		$qt=$qts[$i];
		$sql = "select * from v_answersheet where examID='$examID' and userID='$userID' and qType='{$qt}'";
		$qs[$i] = $db->getRows($sql);
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
		.hd-tb{width:100%;}
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
	<input type="hidden" id="pageName" name="pageName" value="<?php echo $p;?>" />
	<input type="hidden" id="examID" name="examID" value="<?php echo $examID;?>" />
	<input type="hidden" id="userID" name="userID" value="<?php echo $userID;?>" />
	<div class="g-hd-1">
		<div>
			<table class='hd-tb'>
				<tr>
					<td style="text-align:left;">
						<?php echo $exam['yyyy'].'级'.$exam['majoyName'].'专业学期'.$exam['term'].$exam['courseName'].$exam['examType'].'考试'; ?>
					</td>
					<td style="text-align:right;">
						<?php echo $student['yyyy'].'级'.$student['majoyName'].$student['classNo'].'班 '.$student['fullName']?>
						<a href="index.php?p=logout">退出</a>&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</div>
	</div>
	<!--doc body-->
	<div class="g-md">
		<div class="g-qbar" style="padding-left:0px;">
			<table class="tb-qbar">
				<tr>
					<td><a href="javascript:void(0);" class="btn-1 qType" id="dan" style="width:80px;">单选</a></td>
					<td><a href="javascript:void(0);" class="btn-1 qType" id="duo" style="width:80px;">多选</a></td>
					<td><a href="javascript:void(0);" class="btn-1 qType" id="pan" style="width:80px;">判断</a></td>
					<td><a href="javascript:void(0);" class="btn-1 qType" id="tian" style="width:80px;">填空</a></td>
					<td><a href="javascript:void(0);" class="btn-1 qType" id="wen" style="width:80px;">问答</a></td>
				</tr>
			</table>
		</div>
		<div class="g-content">
			<div class="m-qs dan"><?php
				if(isset($qs[0])){foreach ($qs[0] as $q){display_q($q);}}
			?></div>
			<div class="m-qs duo" style="display:none"><?php
				if(isset($qs[1])){foreach ($qs[1] as $q){display_q($q);}}
			?></div>
			<div class="m-qs pan" style="display:none"><?php
				if(isset($qs[2])){foreach ($qs[2] as $q){display_q($q);}}
			?></div>
			<div class="m-qs tian" style="display:none"><?php
				if(isset($qs[3])){foreach ($qs[3] as $q){display_q($q);}}
			?></div>
			<div class="m-qs wen" style="display:none"><?php
				if(isset($qs[4])){foreach ($qs[4] as $q){display_q($q);}}
			?></div>
		</div>
	</div>
	<div class="g-ft">
		<b>Copyright © 2015 Orange.com All Rights Reserved</b>
	</div>
</div>
<!--js-->
<script>
$(document).ready(function(){
	$(".qType").click(function(){
		$(".qType").css('background','');
		$(this).css('background','#cc0000');
		var qType = $(this).attr('id');
		$(".m-qs").hide();
		$('.'+qType).show();
	});
	$(".saveAnswer").click(function(){
		var theBtn = $(this);
		var field_box = theBtn.parent().siblings(".qa").eq(0);
		var answer1 = encodeURIComponent($.trim(get_form_field_value(field_box)));
		var qID = theBtn.parents(".q").children(".qID").val();
		var userID = $(":input[name='userID']").eq(0).val();
		var examID = $(":input[name='examID']").eq(0).val();
		var sendData = "examID="+examID+"&userID="+userID+"&qID="+qID+"&answer1="+answer1;
		$.ajax({
			url:'index.php?p=exam.ajax&a=saveAnswer&r='+Math.random(),
			type:'post',
			data:sendData,
			datatype:'text',
			success:function(data){
				if(data=='')
				{
					theBtn.css('color','#339933');
				}
				else
				{
					alert("保存答案失败请重试");
				}
			},
			error:function(){
			}
		});
	});
	$("#dan").trigger("click");
});
</script>
</body>
</html>