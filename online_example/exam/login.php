<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $app_name;?></title>
<script language="javascript" type="text/javascript" src="/js/jquery-1.7.2.js"></script>
<script language="javascript" type="text/javascript" src="/js/functions.js"></script>
<link href="/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="g-doc">
	<div class="g-hd">
		<ul class="labels">
			<li class="label">登 录</li>
			<li class="label">注 册</li>
		</ul>
	</div>
	<div class="g-md">
		<div class="tag">
			<div>
				<form method="post" action="index.php" name="fm-login">
					<input type='hidden' name='login' value='login' />
					<table>
						<tr><td><b>账号</b></td><td><input type="text" name="userName" class="u-ipt"/></td></tr>
						<tr><td><b>密码</b></td><td><input type="password" name="pwd" class="u-ipt" /></td></tr>
						<tr><td></td><td><a href="javascript:void(0);" class="btn" id="btn-login"><b>登 录</b></a></td></tr>
						<tr><td></td><td style="text-align:center;color:#cc0000;"><b><?php if($msg!=null) echo $msg;?></b></td></tr>
					</table>
				</form>
			</div>						
		</div>
		<div class="tag">
			<div>
				<form method="post" action="index.php?p=register" name="fm-register">
					<table>
						<tr><td><b>年级</b></td><td><input type="text" name="yyyy" class="u-ipt" /></td></tr>
						<tr><td><b>专业</b></td><td><input type="text" name="majoyName" class="u-ipt" /></td></tr>
						<tr><td><b>班号</b></td><td><input type="text" name="classNo" class="u-ipt" /></td></tr>
						<tr><td><b>账号</b></td><td><input type="text" name="userName" class="u-ipt"/></td></tr>
						<tr><td><b>姓名</b></td><td><input type="text" name="fullName" class="u-ipt" /></td></tr>
						<tr><td><b>学号</b></td><td><input type="text" name="studentNo" class="u-ipt" /></td></tr>
						<tr><td><b>密码</b></td><td><input id="pwd" type="password" name="pwd" class="u-ipt" /></td></tr>
						<tr><td><b>再次输入密码</b></td><td><input id="pwd1" type="password" name="pwd1" class="u-ipt" /></td></tr>
						<tr><td></td><td><a href="javascript:void(0);" class="btn" id="btn-register"><b>注 册</b></a></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<div class="g-ft"><b>Copyright © 2015 Orange.com All Rights Reserved</b></div>
</div>
<script>
$(document).ready(function(){
	var labels=$(".label");
	var tags=$(".tag");
	labels.eq(0).css("background","#fff");
	labels.eq(0).siblings().css("background","");
	tags.eq(0).siblings().hide();
	tags.eq(0).show();
	
	$(".label").click(function(){
		tag_switch($(this),labels,tags);
	});
	
	$(".btn").click(function(){
		var fm = $(this).parents("form").eq(0);
		var ipts = $(this).parent().parent().siblings('tr').children('td').children('.u-ipt');
		for(var i=0;i<ipts.length;i++){
			var ipt = ipts.eq(i);
			var fn=ipt.attr('name');// 字段名
			var fv=ipt.attr('value');// 字段值
			try
			{
				if(regs[fn]!=null)
				{
					reg_check(regs[fn],fv); // 会抛出异常
				}
			}
			catch (e)
			{
				alert(e.message);
				return false;
			}
		}
		if($(this).attr('id')=='btn-register'){
			var pwd = $("#pwd").eq(0).val();
			var pwd1 = $("#pwd1").eq(0).val();
			if(pwd!=pwd1)
			{
				alert('前后两次输入的密码不一致');
				return false;
			}
		}
		fm.submit();
	});

	$("form:[name='fm-register'] input[name='userName']").change(function(){
		var ipt_userName =$(this)
		var userName = ipt_userName.val();
		$.ajax({
			url:"index.php?p=login.ajax&userName="+userName+"&a=check_uname"+"&r="+Math.random(),
			type:"get",
			datatype:"text",
			success:function(data){
				if(data=='')
				{
					return;
				}
				else
				{
					ipt_userName.val('');
					alert(data);
				}
			},
			error:function(){
			
			}
		});
	});
});
</script>
</body>
</html>