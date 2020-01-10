<?php
if(isset($_GET['examID']))
{
	$examID = $_GET['examID'];
	$userID = $_SESSION['user']['userID'];
	$sql="select * from v_exams where examID='{$examID}' and testbuilder = '{$userID}'";
	if(!($exam = $db->getRow($sql)))
	{
		$db->db_err('你非本次考试的制卷人无权操作');
	}
	// 标记没做的题目为已批
	$sql = "update v_answersheet set checked='1' where examID={$examID} and answer1 is null";
	$db->U($sql);
	// 答案与标准答案一致的给满分并标记为已批
	$sql = "update v_answersheet set fenshu1=fenshu,checked='1' where examID={$examID} and answer1=answer";
	$db->U($sql);
	// 标记剩余的客观题为已批
	$sql = "update v_answersheet set checked='1' where examID={$examID} and answer1<>answer and (qType = '单选' or qType = '多选' or qType = '判断' )";
	$db->U($sql);
	// 没有批的主观题
	$sql = "select * from v_answersheet where examID='{$examID}' and checked='0'";
	if(!($qs = $db->getRows($sql)))
	{
		$sql = "update exams set examState = '已阅卷' where examID = '{$examID}'";
		$db->U($sql);
		$db->db_err('试卷已批阅完');
	}
}
else
{
	exit();
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
	<div class="g-hd-1">
		<div>
			<?php echo $exam['yyyy'].'级'.$exam['majoyName'].'专业学期'.$exam['term'].$exam['courseName'].$exam['examType'].'考试'; ?> —— 阅卷
		</div>
	</div>
	<!--doc body-->
	<div class="g-md">
		<div class="g-content">
			<div class="m-qs"><?php
			if(isset($qs))
			{
				foreach ($qs as $q)
				{
					$qID = $q['qID'];
					$userID = $q['userID'];
					$question = $q['question'];
					$answer = $q['answer'];
					$answer1 = $q['answer1'];
					$fenshu = $q['fenshu'];
					echo "<div class=\"q\">";
					echo "<input type=\"hidden\" name=\"qID\" class=\"qID\" value=\"{$qID}\"/>";
					echo "<input type=\"hidden\" name=\"userID\" class=\"userID\" value=\"{$userID}\"/>";
					echo "<div class=\"qo\">";
					for ($i=0;$i<=$fenshu;$i++)
					{
						echo "<a style=\"margin-right:10px;\" href=\"javascript:void(0);\" class=\"defen\">{$i}</a>";
					}
					echo "</div>";
					echo "<div class=\"qb\">{$question}</div>";
					echo "<div class=\"qa\">标准答案：{$answer}</div>";
					echo "<div class=\"qa\">学生答案：{$answer1}</div>";
					echo "</div>";
				}
			}
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
	$(".defen").click(function(){
		var examID = $("#examID").eq(0).val();
		var userID = $(this).parents(".q").children(".userID").eq(0).val();
		var qID = $(this).parents(".q").children(".qID").eq(0).val();
		var fenshu1 = $.trim($(this).eq(0).text());
		var sendData = "examID="+examID+"&userID="+userID+"&qID="+qID+"&fenshu1="+fenshu1+"&checked=1";
		var theBtn=$(this)
		$.ajax({
			url:"index.php?p=dtkgl.yuejuan.ajax&a=yuejuan&r="+Math.random(),
			type:"post",
			data:sendData,
			datatype:'text',
			success:function(data){
				if(data=='')
				{
					theBtn.siblings('a').css('color','');
					theBtn.css('color','#cc0000');
				}
				else
				{
					alert('请重试');
				}
			},
			error:function(){
				alert('请重试');
			}
		});
	});
});
</script>
</body>
</html>