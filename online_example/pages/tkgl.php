<?php
	$courseID = $_GET['courseID'];
	$courseName = $_GET['courseName'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $app_name?></title>
	<script language="javascript" type="text/javascript" src="/js/jquery-1.7.2.js"></script>
	<script language="javascript" type="text/javascript" src="/js/functions.js"></script>
	<script>window.UEDITOR_HOME_URL="/ueditor/";</script>
	<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
	<link href="/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="/css/style.css" rel="stylesheet" type="text/css" />
	<style>
		body,.g-ft{background:#ccc;}
		.g-doc{background:#fff;}
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
		.qc{
		}
		.m-details {
		}
	</style>
</head>
<body>
	<div class="g-doc">
			<input type="hidden" id="pageName" name="pageName" value="<?php echo $p?>" />
			<div class="g-hd-1">
				<span>题库管理 —— <?php echo $courseName?></span>
				<a href="index.php?p=kcgl" style="color:blue;">&nbsp;&nbsp;&nbsp;主页</a>
			</div>
			<!--doc body-->
			<div class="g-md tabList">
				<div class="g-qbar" style="padding-left:0px;">
					<table class="tb-qbar">
						<tr>
							<input type="hidden" name="courseID" value="<?php echo $courseID;?>"/>
							<input type="hidden" name="qType" />
							<td><a href="javascript:void(0);" class="btn-1 query" id="query1" style="width:80px;">单选</a></td>
							<td><a href="javascript:void(0);" class="btn-1 query" id="query2" style="width:80px;">多选</a></td>
							<td><a href="javascript:void(0);" class="btn-1 query" id="query3" style="width:80px;">判断</a></td>
							<td><a href="javascript:void(0);" class="btn-1 query" id="query4" style="width:80px;">填空</a></td>
							<td><a href="javascript:void(0);" class="btn-1 query" id="query5" style="width:80px;">问答</a></td>
							<td>
								<div class="m-pgbar" style="display:none;background:#fff;">
									<a href="javascript:void(0);" id="prevPage" style="color:blue;"><b>上一页</b></a>
									<span id="pageNo">0</span><span>/</span><span id="maxPageNo">0</span>
									<a href="javascript:void(0);" id="nextPage" style="color:blue;"><b>下一页</b></a>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="g-content">
					<div class="m-qs">
					</div>
				</div>
			</div>
			<div class="g-md tabDetails">
				<div class="g-content">
					<div style="padding:8px;">
						<table class="m-details" id="m-details" border="1px" bordercolor="#ccc">
							<input type="hidden" class="" name="qID" />
							<input type="hidden" class="" name="qType" />
							<input type="hidden" name="courseID"/>
							<tr>
								<td>题干</td>
								<td class="form_f_box" style="text-align:left;">
									<div class="qb">
										<textarea id="qb" name="question" />
										</textarea>
									</div>
								</td>
							</tr>
							<tr>
								<td>答案</td>
								<td class="form_f_box" style="text-align:left;">
									<div class="qa" style="margin:0px;padding:0px;">
									</div>
								</td>
							</tr>
							<tr>
								<td>解释</td>
								<td class="form_f_box" style="text-align:left;">
									<div class="qc">
										<textarea name="cmt" />
										</textarea>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="f-bar" style="text-align:center;background:#fff;">
										<a href="javascript:void(0);" class="edit">编辑</a>
										<a href="javascript:void(0);" class="del">删除</a>
										<a href="javascript:void(0);" class="confirm">提交</a>
										<a href="javascript:void(0);" class="add">新增</a>
										<a href="javascript:void(0);" class="cancel">返回</a>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<!--js-->
			<script>
				$(document).ready(function(){
					window.ue=UE.getEditor("qb",{toolbars:ue_tool_bars,initialFrameHeight:200,initialFrameWidth:1080,initialStyle:'p{font:14px/1.5 Microsoft Yahei;}'});
					doc_ready();
				});
			</script>
			<div class="g-ft">
				<b>Copyright © 2015 Orange.com All Rights Reserved</b>
			</div>
		</div>
	</body>
</html>