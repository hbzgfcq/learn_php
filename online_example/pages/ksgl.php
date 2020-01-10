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
<!--js-->
<script>
$(document).ready(function(){
	doc_ready();
});
</script>
<!--doc footer-->
<?php require('/includes/footer.inc.php');?>