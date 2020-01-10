<?php
	$examID = $_GET['examID'];
	// 权限审核
	$userID = $_SESSION['user']['userID'];
	$sql="select * from v_exams where examID='{$examID}' and testbuilder = '{$userID}'";
	if(!($exam = $db->getRow($sql)))
	{
		$db->db_err('你非本次考试的制卷人无权组卷');
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
		.div_fstj{
			background:#9966cc;
			width:180px;
			position:fixed;
			right:30px;
			top:50px;
			padding:10px;
		}
		.div_fstj table{
			width:100%;
		}
		.div_fstj td{
			padding:4px;
			border:1px #ccc solid;
			font-weight:bold;
		}
		.div_fstj .u-ipt{
			padding:2px;
			width:30px;
			text-align:center;
		}
	</style>
</head>

<body>

<div class="g-doc">
	<div class="div_fstj">
		<div>
			<table>
				<tr>
					<td>总分</td>
					<td colspan="2"><span class="sum">0</span> / <span class="fullScore"><?php echo $exam['fullScore'];?></span></td>
					<td><a class="finish" href="javascript:void(0);">完成</td>
				</tr>
				<tr>
					<td>题型</td>
					<td>分/题</td>
					<td>题数</td>
					<td>分数</td>
				</tr>
				<tr>
					<td>单选</td>
					<td><input type="test" class="u-ipt fmt" value="0"/></td>
					<td class='ts'>0</td>
					<td class='fs'>0</td>
				</tr>
				<tr>
					<td>多选</td>
					<td><input type="test" class="u-ipt fmt" value="0"/></td>
					<td class='ts'>0</td>
					<td class='fs'>0</td>
				</tr>
				<tr>
					<td>判断</td>
					<td><input type="test" class="u-ipt fmt" value="0"/></td>
					<td class='ts'>0</td>
					<td class='fs'>0</td>
				</tr>
				<tr>
					<td>填空</td>
					<td><input type="test" class="u-ipt fmt" value="0"/></td>
					<td class='ts'>0</td>
					<td class='fs'>0</td>
				</tr>
				<tr>
					<td>问答</td>
					<td><input type="test" class="u-ipt fmt" value="0"/></td>
					<td class='ts'>0</td>
					<td class='fs'>0</td>
				</tr>
			</table>
		</div>
	</div>
	<input type="hidden" id="pageName" name="pageName" value="<?php echo $p?>" />
	<div class="g-hd-1">
		<?php echo $exam['yyyy'].'级'.$exam['majoyName'].'专业'.'学期'.$exam['term'].$exam['courseName'].$exam['examType'].'考试';?> —— 组 卷
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
function tjfs(){
	var sum = 0;
	var trs = $(".div_fstj tr");
	for(var i=2;i<7;i++){
		var theTr = trs.eq(i);
		var fmt = theTr.children('td:eq(1)').children('input.fmt').val();
		var ts = theTr.children('td:eq(2)').text();
		var fs = parseInt(fmt)*parseInt(ts);
		theTr.children('td:eq(3)').text(fs);
		var sum = sum + fs;
	}
	$("span.sum").text(sum);
}
$(document).ready(function(){
	var paper = {0:[],1:[],2:[],3:[],4:[]};
	var examID = $(".tb-qbar :input[name='examID']").val();
	var div_qs = $(".m-qs");
	
	$(".query").click(function(){
		$(".query").css('background','');
		$(this).css('background','#cc0000');
		$(".tb-qbar :input[name='qType']").val($(this).text());
		
		var qType = encodeURIComponent($.trim($(".tb-qbar :input[name='qType']").val()));
		var strUrl = "index.php?p=sjgl.zujuan.ajax&a=R&examID="+examID+"&qType="+qType+"&pageNo=0&pageSize=10000&r="+Math.random();
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
					alert('题库中还没有该类型的题目');
					return;
				}	
				
				div_qs.empty();// 清空容纳题目的DIV
				for(var i = 0; i < rows.length;i++)
				{
					var q = rows[i];
					var qBox = $("<div></div>").addClass('q');
					qBox.append("<div></div>").addClass('qo').append("<input id='"+q['qID']+"' type='checkbox' class='selectq' name = 'selectq' />").append("<input type='hidden' name='qID' value='" +q['qID']+"' />");
					qBox.append($("<div></div>").addClass('qb').html(q['question']));
					qBox.append($("<div></div>").addClass('qa').text(q['answer']));
					div_qs.append(qBox);
				}
				
				var qType =$(".tb-qbar :input[name='qType']").val();// 当前的题型
				var n = (qType=='单选')?0:((qType=='多选')?1:((qType=='判断')?2:((qType=='填空')?3:4)));
				
				// 恢复选择已选的题目
				for(var i=0;i<paper[n].length;i++)
				{
					$('#'+paper[n][i]).attr('checked',true);
				}

				$(".selectq").click(function(){
					var theTR = $(".div_fstj tr").eq(n+2);
					var checked = $(".selectq:checked");
					theTR.children('td').eq(2).text(checked.length);
					// 保存已选题目的ID
					paper[n]= [];
					tjfs();
					for(var i=0;i<checked.length;i++)
					{
						var qID = checked.eq(i).attr('id');
						paper[n].push(qID);
					}
				});
			},
			error:function(){
				alert('访问数据库失败');
			}
		});

		$("input.fmt").change(function(){
			var fmt = $(this).val();
			if(!(/^[1-9][0-9]{0,1}$/.test(fmt)))
			{
				alert('每题分数的格式错');
				$(this).val(0);
			}
			tjfs();
		});
	});

	$(".finish").click(function(){
		if($("span.sum").eq(0).text()!=$("span.fullScore").eq(0).text()){
			alert('题目数目不足，请继续选题');
			return;
		}
		else
		{
			var sendData = '';
			for(var i=0;i<5;i++)
			{
				var fmt = $(".div_fstj tr").eq(i+2).children("td:eq(1)").children('input.fmt').eq(0).val();
				for (var j=0;j<paper[i].length;j++)
				{
					sendData+=(paper[i][j]+':'+fmt+',');
				}
			}
			sendData ="id_c_s="+sendData.substring(0,sendData.length-1);
			var strUrl = "index.php?p=sjgl.zujuan.ajax&a=C&examID=" + examID + "&r=" + Math.random();
			$.ajax({
				url:strUrl,
				type:'post',
				data:sendData,
				datatype:'text',
				success:function(data){
					if(data=='')
					{
						data = '组卷胜利完工';
					}
					alert(data);
				},
				error:function(){
					alert('组卷失败了');
				}
			});
		}
	});
});

</script>
</body>

</html>