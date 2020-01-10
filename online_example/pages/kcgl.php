<!--doc header-->
<?php require('/includes/header.inc.php');?>
<!--doc body-->
<div class="g-md tabList">
	<div class="g-qbar">
		<table class="tb-qbar">
			<tr>
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
					<td>课程ID</td>
					<td class="form_f_box" name="courseID" ><input type="text" class="u-ipt iLock uLock" name="courseID" /></td>
				</tr>
				<tr>
					<td>课程名</td>
					<td class="form_f_box" name="courseName" ><input type="text" class="u-ipt" name="courseName" /></td>
				</tr>
				<tr>
					<td>负责人</td>
					<td class="form_f_box" name="fullName" ><input type="text" class="u-ipt" name="fullName" /></td>
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