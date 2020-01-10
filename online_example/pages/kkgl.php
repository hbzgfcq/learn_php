<!--doc header-->
<?php require('/includes/header.inc.php');?>
<!--doc body-->
<div class="g-md tabList">
	<div class="g-qbar">
		<table class="tb-qbar">
			<tr>
				<td>年级</td><td><input type="text" class="u-ipt check" style="width:80px;" name="yyyy"/></td>
				<td>专业</td><td><input type="text" class="u-ipt check" style="width:80px;" name="majoyName"/></td>
				<td>学期</td><td><input type="text" class="u-ipt check" style="width:80px;" name="term"/></td>
				<td><a href="javascript:void(0);" class="btn" id="query" style="width:80px;">查询</a></td>
				<td><a href="javascript:void(0);" class="btn" id="create" style="width:80px;">增加</a></td>
			</tr>
		</table>
	</div>
	<div class="g-content">
		<table class="m-dt" id="m-dt">
		</table>
		<div class="m-pgbar" style="display:none;">
			<a href="javascript:void(0);" id="prevPage"><b>上一页</b></a>
			<span id="pageNo">0</span><span>/</span><span id="maxPageNo">0</span>
			<a href="javascript:void(0);" id="nextPage"><b>下一页</b></a>
		</div>
	</div>
</div>
<div class="g-md tabDetails">
	<div class="g-content">
		<div class="f-b1px">
			<table class="m-details" id="m-details">
				<tr>
					<td>开课ID</td>
					<td class="form_f_box" name="courseSettingID" ><input type="text" class="u-ipt uLock iLock" name="courseSettingID" /></td>
				</tr>
				<tr>
					<td>年级</td>
					<td class="form_f_box" name="yyyy" ><input type="text" class="u-ipt" name="yyyy" /></td>
				</tr>
				<tr>
					<td>专业名</td>
					<td class="form_f_box" name="majoyName" ><input type="text" class="u-ipt" name="majoyName" /></td>
				</tr>
				<tr>
					<td>学期</td>
					<td class="form_f_box" name="term" ><input type="text" class="u-ipt" name="term" /></td>
				</tr>
				<tr>
					<td>课程名</td>
					<td class="form_f_box" name="courseName" ><input type="text" class="u-ipt" name="courseName" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="f-bar">
							<a href="javascript:void(0);" class="edit">编辑</a>
							<a href="javascript:void(0);" class="del">删除</a>
							<a href="javascript:void(0);" class="confirm">提交</a>
							<a href="javascript:void(0);" class="add">新增</a>
							<a href="javascript:void(0);" class="cancel">取消</a>
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
	doc_ready();
});
</script>
<!--doc footer-->
<?php require('/includes/footer.inc.php');?>