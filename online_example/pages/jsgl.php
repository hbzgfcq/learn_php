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
					<td>用户ID</td>
					<td class="form_f_box" name="userID" ><input type="text" class="u-ipt iLock uLock" name="userID" /></td>
				</tr>
				<tr>
					<td>用户名</td>
					<td class="form_f_box" name="userName" ><input type="text" class="u-ipt uLock" name="userName" /></td>
				</tr>
				<tr>
					<td>姓名</td>
					<td class="form_f_box" name="fullName" ><input type="text" class="u-ipt" name="fullName" /></td>
				</tr>
				<tr>
					<td>密码</td>
					<td class="form_f_box" name="pwd" ><input type="text" class="u-ipt" name="pwd" /></td>
				</tr>
				<tr>
					<td>审核</td>
					<td class="form_f_box" name="checked" ><input type="checkbox" class="" name="checked" /></td>
				</tr>
				<tr>
					<td>管理员</td>
					<td class="form_f_box" name="isAdmin" ><input type="checkbox" class="" name="isAdmin" /></td>
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