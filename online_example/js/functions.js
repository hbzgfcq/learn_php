var ue_tool_bars=[
    [
        'source', //源代码
        'undo', //撤销
        'redo', //重做
        'subscript', //下标
        'superscript', //上标
        'selectall', //全选
        'preview', //预览
        'mergeright', //右合并单元格
        'mergedown', //下合并单元格
        'deleterow', //删除行
        'deletecol', //删除列
        'splittorows', //拆分成行
        'splittocols', //拆分成列
        'splittocells', //完全拆分单元格
        'deletecaption', //删除表格标题
        'inserttitle', //插入标题
        'mergecells', //合并多个单元格
        'deletetable', //删除表格
        'insertparagraphbeforetable', //"表格前插入行"
        'fontfamily', //字体
        'fontsize', //字号
        'simpleupload', //单图上传
		'insertimage',
        'edittable', //表格属性
        'edittd', //单元格属性
        'spechars', //特殊字符
        'searchreplace', //查询替换
        'justifyleft', //居左对齐
        'justifyright', //居右对齐
        'justifycenter', //居中对齐
        'justifyjustify', //两端对齐
        'forecolor', //字体颜色
        'insertorderedlist', //有序列表
        'insertunorderedlist', //无序列表
        'imagenone', //默认
        'imageleft', //左浮动
        'imageright', //右浮动
        'imagecenter', //居中
        'edittip ', //编辑提示
        'inserttable', //插入表格
        'charts', // 图表
    ]
];
// 分页的大小
var pageSize=5;
// 菜单项索引
var m_item_index={'zygl':0,'jsgl':1,'bjgl':2,'xsgl':3,'kcgl':4,'kkgl':5,'ksgl':6,};
// 正则表达式
var regs={
	'userName':[{reg:/^[1-9][0-9]{4,14}$/,errMsg:'用户名格式错'},{reg:/\S/,errMsg:'用户名不能为空'}],
	'pwd':[{reg:/^[0-9]{6,12}$/,errMsg:'密码格式错'},{reg:/\S/,errMsg:'密码不能为空'}],
	'yyyy':[{reg:/^20[0-9]{2}$/,errMsg:'年级格式错'},{reg:/\S/,errMsg:'年级不能为空'}],
	'majoyName':[{reg:/\S/,errMsg:'专业名不能为空'}],
	'schooling':[{reg:/^[2,3,4,5]$/,errMsg:'学制格式错'},{reg:/\S/,errMsg:'学制不能为空'}],
	'fullName':[{reg:/\S/,errMsg:'姓名不能为空'}],
	'courseName':[{reg:/\S/,errMsg:'课程名不能为空'}],
	'classNo':[{reg:/^[1-9][0-9]{0,1}$/,errMsg:'班号格式错'},{reg:/\S/,errMsg:'班号不能为空'}],
	'qType':[{reg:/^(单选|多选|判断|填空|问答)$/,errMsg:'题型只能是单选，多选，判断，填空，问答'},{reg:/\S/,errMsg:'题型不能为空'}],
	'term':[{reg:/^[1-8]$/,errMsg:'学期格式错'},{reg:/\S/,errMsg:'学期不能为空'}],
	'examType':[{reg:/^(期中|期末|模拟[1-9]|技能竞赛[1-9]|单元测试[1-9])$/,errMsg:'考试类型只能是期中，期末，模拟n，单元测试n，技能竞赛n'},{reg:/\S/,errMsg:'考试类型不能为空'}],
	'fullScore':[{reg:/^[1-9][0-9]{0,2}$/,errMsg:'总分格式不对'},{reg:/\S/,errMsg:'总分不能为空'}],
	'howLong':[{reg:/^[1-9][0-9]{0,2}$/,errMsg:'总分格式不对'},{reg:/\S/,errMsg:'总分不能为空'}],
};
// 正则表达式检查
function reg_check(regs,fieldValue)
{
	for (var i=0;i<regs.length;i++)
	{
		if(regs[i].reg.test(fieldValue)==false)
		{
			throw new Error(regs[i].errMsg);
		}
	}
}
// 数据表的字段
var cols_of_tbs={
	zygl:{majoyID:'专业ID',yyyy:'年级',majoyName:'专业名',schooling:'学制'},
	jsgl:{userID:'用户ID',userName:'用户名',pwd:'密码',fullName:'姓名',checked:'审核',isAdmin:'管理员'},
	bjgl:{classID:'班级ID',yyyy:'年级',majoyName:'专业名',classNo:'班级号',majoyID:'专业ID'},
	xsgl:{userID:'用户ID',userName:'用户名',fullName:'姓名',yyyy:'年级',majoyName:'专业名',classNo:'班级号',majoyID:'专业ID',pwd:'密码'},
	kcgl:{courseID:'课程ID',courseName:'课程名',fullName:'负责人'},
	tkgl:{qID:'题目ID',qType:'题型',question:'题干',answer:'答案',cmt:'讲解'},
	kkgl:{courseSettingID:'开课ID',yyyy:'年级',majoyName:'专业名',term:'学期',courseName:'课程名',majoyID:'专业ID',courseID:'课程ID'},
	ksgl:{examID:'考试ID',yyyy:'年级',majoyName:'专业名',term:'学期',courseName:'课程名',examType:'考试类型',examState:'状态',fullScore:'总分',timeOfEnd:'结束时间',howLong:'时长',fullName:'制卷人',majoyID:'专业ID',courseID:'课程ID',courseSettingID:'开课ID'},
};
// 页就绪时调用的函数
function doc_ready(){
	$("div.tabList").show();
	$("div.tabDetails").hide();
	
	var p = $("#pageName").eq(0).val();// 页名
	$(".m-item").eq(m_item_index[p]).css("color",'#DC143C'); // 高亮显示当前的菜单项	
	
	var strUrl='';
	var criteria_inputs = $(".tb-qbar :input"); // 查询栏中的条件输入框
	var cols = cols_of_tbs[p];
	var tab_dt=$("#m-dt").eq(0);
	var div_qs=$(".m-qs").eq(0);
	var form_f_boxs = $(".form_f_box");
	var currentRow = null;
	var pageNo=0;
	
	$("#create").click(function(){
		$("div.tabList").hide();
		$("div.tabDetails").show();
		$(".m-details :input").val('');
		
		$(".add").trigger("click");
	});

	$("#query,#query1,#query2,#query3,#query4,#query5").click(function(){
		$("#pageNo").text("0");
		query(this,p,cols,tab_dt,div_qs,criteria_inputs);
	});

	$("#prevPage").click(function(){
		prevPage(p,cols,tab_dt,div_qs,criteria_inputs)
	});

	$("#nextPage").click(function(){
		nextPage(p,cols,tab_dt,div_qs,criteria_inputs);
	});

	$(".edit").click(function(){
		if($(".m-details :input").eq(0).val()!='')
		{
			strUrl = "index.php?p=" + p + ".ajax&a=U&r=" + Math.random();
			$(".form_f_box :input").removeAttr('disabled');
			$(".uLock").attr('disabled',true);
			$(".edit,.del,.add,.confirm").hide();
			$(".confirm").show();
			return false;
		}
	});

	$(".cancel").click(function(){
		$(".tabDetails").hide();
		$(".tabList").show();
		$(".form_f_box :input").val('');
	});
	
	$(".confirm").click(function(){
		var n2vs;
		if(p=='tkgl')
		{
			var courseID = $(".tb-qbar :input[name='courseID']").val();
			var qID = $(".m-details :input[name='qID']").val();
			var qType = $(".tb-qbar :input[name='qType']").val();
			var question = $.trim(ue.getContent());
			if($.trim(ue.getContentTxt())=='')
			{
				alert("题干不能为空");
				return false;
			}
			question = encodeURIComponent(question);
			var ips = $(".m-details .qa :input");
			var answer='';
			switch(qType){
				case '单选':
				case '多选':
				case '判断':
					for(var i=0;i<ips.length;i++){
						if(ips.eq(i).is(":checked")==true)
						{
							answer += '1';
						}
						else
						{
							answer +='0';
						}
					}
					break;
				case '填空':
				case '问答':
					answer = ips.eq(0).val();
					break;
			}
			answer = $.trim(answer);
			if(answer==''||answer=='0000')
			{
				alert("答案不能为空");
				return false;
			}
			answer = encodeURIComponent(answer);
			var cmt = $.trim($(".m-details .qc :input").eq(0).val());
			cmt=((cmt=='')?'太简单不解释':cmt);
			cmt=encodeURIComponent(cmt);
			
			n2vs = "&courseID="+courseID+"&qID="+qID+"&qType="+qType+"&question="+question+"&answer="+answer+"&cmt="+cmt;
		}
		else
		{
			try
			{
				n2vs = get_n2vs_from_form(form_f_boxs);
			}
			catch(err)
			{
				alert(err.message);
				return;
			}
		}
		
		$.ajax({
			url:strUrl,
			data:n2vs,
			type:"post",
			datatype:"text",
			success:function(data){
				if(data==''){ // 没有返回数据表示真的成功了
					data="成 功";
					$(".edit,.add,.confirm,.del").hide();
					$(".edit,.add,.del").show();
					$(".form_f_box :input").attr("disabled","disabled");	// 提交后禁用所有字段
				}
				alert(data);
			},
			error:function(){
				alert("失 败");
			}
		});
	});

	$(".add").click(function(){		
		strUrl = "index.php?p=" + p + ".ajax&a=C&r=" + Math.random();

		if(p=='tkgl')
		{
			ue.setContent('');
			$(".form_f_box .qa :input").attr('value','').removeAttr('disabled');
			$(".form_f_box .qc :input").attr('value','').removeAttr('disabled');
		}
		else
		{
			$(".form_f_box :input").removeAttr('disabled');
			$(".iLock").attr('disabled',true);
		}
		$(".edit,.del,.add,.confirm").hide();
		$(".confirm").show();
	});
	
	$(".del").click(function(){
		var n2vs;
		var pkname = $(".m-details :input").eq(0).attr("name");
		var pkvalue =  $(".m-details :input").eq(0).val();
		if(pkvalue!=='')
		{
			if(!confirm("真的要删除吗？")) return;
			n2vs = pkname + "=" + pkvalue;
			strUrl = "index.php?p=" + p + ".ajax&a=D&r=" + Math.random();
			$.ajax({
				url:strUrl,
				data:n2vs,
				type:"post",
				datatype:"text",
				success:function(data){
					if(data==''){ // 没有返回数据表示真的成功了
						data="成功";
					}
					alert(data);
				},
				error:function(){
					alert("失败");
				}
			});
		}
	});
}

function query(qbtn,p,cols,tab_dt,div_qs,criteria_inputs){
	// 清理的工作
	$(".m-details :input").val('');
	
	// 生成查询条件
	if(p=='tkgl')
	{
		$(".tb-qbar input[name='qType']").val($(qbtn).text());
		$("#query1,#query2,#query3,#query4,#query5").css('background','');
		$(qbtn).css("background","#DC143C");
	}
	
	try
	{
		var strSendData = build_query_criteria(criteria_inputs);
	}
	catch (err)
	{
		alert(err.message);
		return;
	}

	var pageNo=$("#pageNo").text();
	var strUrl = "index.php?p="+p+".ajax&a=R&pageNo=" + pageNo + "&pageSize=" + pageSize + "&r=" + Math.random();
	$.ajax({
		url:strUrl,
		data:strSendData,
		type:'post',
		datatype:'json',			
		success:function(data){
			query_success(data,p,cols,div_qs,tab_dt);
		},
		error:function(){
			alert("获取数据失败");
		}
	});
}

function display_data(data,p,cols,div_qs,tab_dt){
	try
	{
		if(data=='') throw new Error("没有检索到数据");
		var data = eval(data);
		var sumRows = data.shift()['sumRows']; // 记录的总行数
		var rows = data;
	}
	// 数据为空时的处理
	catch (err)
	{		
		if(p=='tkgl')
		{
			div_qs.empty();// 清空容纳题目的DIV
			if(!confirm("题库为空,现在要录入题目吗？"))
			{
				return;
			}
			else
			{
				display_add_question_tab(); // 显示 增加题目到题库 标签页
			}
			return;
		}
		else
		{
			tab_dt.empty();
			alert(err.message);
			return;
		}
	}
	
	// 数据不为空时的处理
	if(p=='tkgl')
	{
		display_questions(div_qs,cols,rows);
	}
	else
	{
		display_rows(tab_dt,cols,rows);
	}
	
	display_paging_bar(sumRows);
}

function add_operate_btns(p){	
	var link = "<a class='details' href='javascript:void(0);'>详细</a>"	
	
	if(p=='ksgl')
	{
		var td_ops = $(".m-dt tr td:first-child");
		td_ops.eq(0).css("width","80px");

		for(var i=0;i<td_ops.length;i++)
		{
			var td_op = td_ops.eq(i);
			var examState = td_op.siblings("td.examState").eq(0).text();
			var examID =  td_op.siblings("td.examID").eq(0).text();
			td_op.append("<a style='display:none' href='javascript:void(0);' class='delExam'>删除</a>");
			td_op.append("<a style='display:none' href='javascript:void(0);' class='setupPaper'>组卷</a>");
			td_op.append("<a style='display:none' href='javascript:void(0);' class='startExam'>开考</a>");
			td_op.append("<a style='display:none' href='javascript:void(0);' class='checkPaper'>试卷</a>");
			td_op.append("<a style='display:none' href='javascript:void(0);' class='stopExam'>停考</a>");
			td_op.append("<a style='display:none' href='javascript:void(0);' class='marking'>阅卷</a>");
			td_op.append("<a style='display:none' href='javascript:void(0);' class='checkScore'>成绩</a>");	
			if(examState =='待组卷')
			{
				td_op.children("a.setupPaper").show();
				td_op.children("a.delExam").show();
			}
			else if(examState =='已组卷')
			{
				td_op.children("a.startExam").show();
				td_op.children("a.checkPaper").show();
			}
			else if(examState=='考试中')
			{
				td_op.children("a.stopExam").show();
			}
			else if (examState =='待阅卷')
			{
				td_op.children("a.marking").show();
				td_op.children("a.checkPaper").show();
			}
			else if (examState =='已阅卷')
			{
				td_op.children("a.checkScore").show();
				td_op.children("a.checkPaper").show();
			}
		}
		return;
	}
	
	if(p=='tkgl')
	{
		$(".q").append($("<div></div>").addClass("qo").append(link));
		return;
	}
	
	if(p=='kcgl')
	{
		$(".m-dt tr td:first-child").append(link);
		var trs = $(".m-dt tr");
		trs.eq(0).append($("<th></th>").text("题库"));
		for(var i = 1; i < trs.length;i ++)
		{
			var tr = trs.eq(i);
			var courseID = $.trim(tr.children("td").eq(1).text());
			var courseName = encodeURIComponent($.trim(tr.children("td").eq(2).text()));
			var href = "index.php?p=tkgl&courseID=" + courseID + "&courseName=" + courseName;
			tr.append($("<td></td>").append($("<a>题库</a>").addClass("toTkgl").attr("href",href)));
		}
		return;
	}

	if(p=='kkgl')
	{
		$(".m-dt tr td:first-child").append(link);
		
		var trs = $(".m-dt tr");
		trs.eq(0).append($("<th></th>").text("安排考试"));
		for(var i = 1; i < trs.length;i ++)
		{
			var tr = trs.eq(i);
			tr.append($("<td></td>").append("<a href='javascript:void(0);' class='arrangeExam'>安排考试<a>")
									.append("<span style='color:red;margin-right:3px;'>考试类型</span><input type='text' class='u-ipt' style='width:50px;margin-right:3px;' name='examType' />")
									.append("<span style='color:red;margin-right:3px;'>总分</span><input type='text' class='u-ipt' style='width:50px;margin-right:3px;' name='fullScore' />")
									.append("<span style='color:red;margin-right:3px;'>时长</span><input type='text' class='u-ipt' style='width:50px;margin-right:3px;' name='howLong' />")
									.append("<span style='color:red;margin-right:3px;'>制卷人</span><input type='text' class='u-ipt' style='width:50px;margin-right:3px;' name='fullName' />")
									.append("<a href='javascript:void(0);' class='confirmExam'>确认<a>")
									.append("<a href='javascript:void(0);' class='cancelArrange'>取消<a>"));
			$(".arrangeExam").siblings().hide();
		}
		return;
	}
	
	$(".m-dt tr td:first-child").append(link);

}

function query_success(data,p,cols,div_qs,tab_dt){	
	
	display_data(data,p,cols,div_qs,tab_dt);

	add_operate_btns(p);
	
	$(".details").click(function(){
		$("div.tabList").hide();
		$("div.tabDetails").show();
		$(".edit,.del,.add,.confirm").show();
		$(".confirm").hide();
		if(p=='tkgl')
		{
			copy_question_from_list_to_details(this);
			$(".form_f_box .qa :input").attr('disabled','disabled');
			$(".form_f_box .qc :input").attr('disabled','disabled');
		}
		else
		{
			copy_record_from_list_to_details(this);					
			$(".form_f_box :input").attr('disabled','disabled');
		}
		return;
	});
	/*************************************************************/
	$(".arrangeExam").click(function(){// 准备安排考试
		$(".arrangeExam").hide();
		$(this).siblings().show();
	});
	
	$(".cancelArrange").click(function(){// 取消安排考试

		$(this).parent().children().hide();
		$(".arrangeExam").show();
		$(this).siblings(":input").val('');
	});

	$(".confirmExam").click(function(){// 确认考试安排
		var n2vs ='';
		var ips = $(this).parent().children(":input");
		var btn = this;
		for (var i=0;i<ips.size();i++ )
		{
			var n = ips.eq(i).attr('name');
			var v = ips.eq(i).attr('value');
			try
			{
				reg_check(regs[n],v);
			}
			catch (e)
			{
				alert(e.message);
				return false;
			}
			v = encodeURIComponent(v);
			n2vs += ( '&' + n + '=' + v);
		}
		n2vs += ('&courseSettingID='+$(this).parents('tr').children('td.courseSettingID').text());

		var strUrl = "index.php?p=ksgl.ajax&a=C&r="+Math.random();
		
		$.ajax({
			url:strUrl,
			type:'post',
			data:n2vs,
			dataType:'text',
			success:function(data){
				if(data=='')
				{
					data='添加考试成功！';
					$(btn).parent().children().hide();
					$(".arrangeExam").show();
					$(btn).siblings(":input").val('');
				}
				alert(data);
			},
			error:function(){
				alert('添加考试失败');
			}
		});
	});
	/*************************************************************/
	$(".delExam").click(function(){
		var examID = $.trim($(this).parent().siblings("td.examID").text());
		var strUrl = "index.php?p=ksgl.ajax&a=D&examID="+examID+"r="+Math.random();
		$.ajax({
			url:strUrl,
			type:'post',
			datatype:'text',
			success:function(data){
				if(data=='')
				{
					data = '删除考试成功';
					$("#query").trigger('click');// 在前台刷新
				}
				alert(data);
			},
			error:function(){
				data = '删除考试成功';
			}
		});
	});

	$(".startExam").click(function(){
		var examID = $(this).parent().siblings("td.examID").eq(0).text();
		var strUrl = "index.php?p=ksgl.ajax&a=start_exam&examID="+examID+"&r="+Math.random();
		$.ajax({
			url:strUrl,
			type:'get',
			success:function(data){
				if(data=='')
				{
					data="开考成功";
					$("#query").trigger('click');// 在前台刷新
				}
				alert(data);
			},
			error:function(){}
		});
	});

	$(".setupPaper").click(function(){// 进入组卷页面
		if($(".login-bar b").eq(0).text()!=$(this).parent().siblings('td.fullName').eq(0).text())
		{
			alert('你非本次考试制卷人无权操作');
			return;
		}
		else
		{
			window.location.href="index.php?p=sjgl.zujuan&examID="+$(this).parent().siblings('td.examID').eq(0).text();
		}
	});

	$(".checkPaper").click(function(){
		if($(".login-bar b").eq(0).text()!=$(this).parent().siblings('td.fullName').eq(0).text())
		{
			alert('你非本次考试制卷人无权操作');
			return;
		}
		else
		{
			window.location.href="index.php?p=sjgl.check&examID="+$(this).parent().siblings('td.examID').eq(0).text();
		}
	});

	$(".marking").click(function(){
		if($(".login-bar b").eq(0).text()!=$(this).parent().siblings('td.fullName').eq(0).text())
		{
			alert('你非本次考试制卷人无权操作');
			return;
		}
		else
		{
			window.location.href="index.php?p=dtkgl.yuejuan&examID="+$(this).parent().siblings('td.examID').eq(0).text();
		}
	});

	$(".stopExam").click(function(){
		var examID = $(this).parent().siblings("td.examID").eq(0).text();
		var strUrl = "index.php?p=ksgl.ajax&a=stop_exam&examID="+examID+"&r="+Math.random();
		$.ajax({
			url:strUrl,
			type:'get',
			success:function(data){
				if(data=='')
				{
					data="停考成功";
					$("#query").trigger('click');// 在前台刷新
				}
				alert(data);
			},
			error:function(){}
		});		
	});

	$(".checkScore").click(function(){
		var examID = $(this).parent().siblings("td.examID").eq(0).text();	
		window.location.href="index.php?p=dtkgl.checkScore&examID="+$(this).parent().siblings('td.examID').eq(0).text();
	});
}

function display_add_question_tab(){// 显示插入题目的界面
	var qType = $(".tb-qbar input[name='qType']").val();
	var branches = (qType=='判断')?['T','F']:['A','B','C','D'];
	var type = (qType=='多选')?'checkbox':(((qType=='单选')||(qType=='判断'))?'radio':'textarea');
	var div_qa = $(".form_f_box div.qa");
	var n = 4;
	if ( qType=='判断' ) { n=2; }
	div_qa.empty();
	
	switch (qType)
	{
		case '多选':
		case '单选':
		case '判断':
			for(var i=0;i<n;i++)
			{
				div_qa.append($("<span>"+branches[i]+"</span>"));
				var radio_or_checkbox = $("<input type='" + type + "' name='answer'/>");
				radio_or_checkbox.attr("disabled","disabled");
				div_qa.append(radio_or_checkbox);
			}
			break;
		case '填空':
		case '问答':
			div_qa.append($("<textarea name='answer'></textarea>").val(''));
			break;	
	}	
	$("div.tabList").hide();
	$("div.tabDetails").show();
	$(".add").trigger("click");
}

// 上一页
function prevPage(p,cols,tab_dt,div_qs,criteria_inputs){
	var pageNo=$("#pageNo").text();
	var maxPageNo=$("#maxPageNo").text();
	pageNo--;
	pageNo = (pageNo < 0) ? maxPageNo : pageNo;
	
	if(p=='tkgl')
	{
		$("#pageNo").text(pageNo);
		var qType = $(".tb-qbar :input[name='qType']").val();
		var theBtn =$(".tb-qbar a:contains('"+qType+"')");		
		query(theBtn[0],p,cols,tab_dt,div_qs,criteria_inputs);
	}
	else
	{
		$("#pageNo").text(pageNo);		
		query($("#query")[0],p,cols,tab_dt,div_qs,criteria_inputs);
	}
}
// 下一页
function nextPage(p,cols,tab_dt,div_qs,criteria_inputs){
	var pageNo=$("#pageNo").text();
	var maxPageNo=$("#maxPageNo").text();
	pageNo++;
	pageNo = (pageNo > maxPageNo) ? 0:pageNo;
	
	if(p=='tkgl')
	{
		$("#pageNo").text(pageNo);
		var qType = $(".tb-qbar :input[name='qType']").val();
		var theBtn =$(".tb-qbar a:contains('"+qType+"')");
		query(theBtn[0],p,cols,tab_dt,div_qs,criteria_inputs);
	}
	else
	{
		$("#pageNo").text(pageNo);	
		query($("#query")[0],p,cols,tab_dt,div_qs,criteria_inputs);
	}
}

// 标签页切换
function tag_switch(label,labels,tags){
	var i = labels.index(label);
	labels.css("background","");
	label.css("background","#fff");
	tags.hide();
	tags.eq(i).show();
}

function display_questions(div_qs,cols_of_tb,rows){
	div_qs.empty();	
	for(var i=0;i<rows.length;i++)
	{
		display_question(div_qs,rows[i]);
	}
}

function display_question(div_qs,q)
{
	var qBox = $("<div></div>").addClass('q');
	qBox.append("<input type='hidden' name='qID' value='" +q['qID']+"' />");
	qBox.append($("<div></div>").addClass('qb').html(q['question']));
	qBox.append($("<div></div>").addClass('qa').text(q['answer']));
	qBox.append($("<div></div>").addClass('qc').text(q['cmt']));
	div_qs.append(qBox);
}

function display_row(row,cols_of_tb){
	var tr = $("<tr></tr>").append("<td></td>");
	for(var f in cols_of_tb)
	{
		tr.append($("<td></td>").addClass(f).html(row[f]));
	}
	return tr;
}

function display_rows(tab_dt,cols_of_tb,rows){
	tab_dt.empty();	
	var tr = $("<tr></tr>");
	tr.append($("<th></th>").text('操作'));
	for(var f in cols_of_tb)
	{		
		tr.append($("<th></th>").text(cols_of_tb[f]));
	}
	tab_dt.append(tr);

	for(var i=0;i<rows.length;i++)
	{
		tab_dt.append(display_row(rows[i],cols_of_tb));
	}
}

function copy_question_from_list_to_details(obj){
	var q = $(obj).parents("div.q");
	var qID = q.children("input[name='qID']").eq(0).val();
	var qType = $(".tb-qbar input[name='qType']").eq(0).val();
	var courseID =  $(".tb-qbar input[name='courseID']").eq(0).val();
	var courseName = q.children("input[name='courseName']").eq(0).val();
	var qb = q.children("div.qb").eq(0).html();
	var qa = q.children("div.qa").eq(0).html();
	var qc = q.children("div.qc").eq(0).text();
	
	$(".m-details input[name='qID']").val(qID);
	$(".m-details input[name='qType']").val(qType);
	$(".m-details input[name='courseID']").val(courseID);
	$(".m-details input[name='courseName']").val(courseName);
	
	window.ue.setContent(qb);

	var branches = (qType=='判断')?['T','F']:['A','B','C','D'];
	var type = (qType=='多选')?'checkbox':(((qType=='单选')||(qType=='判断'))?'radio':'textarea');
	var qa_box = $(".form_f_box div.qa");
	qa_box.empty();
	switch (qType)
	{
		case '多选':
		case '单选':
		case '判断':
			for(var i=0;i<qa.length;i++)
			{
				qa_box.append($("<span>"+branches[i]+"</span>"));
				var radio_or_checkbox = $("<input type='" + type + "' name='answer'/>");
				if(qa[i]=='1')
				{
					radio_or_checkbox.attr('checked','checked');
				}
				radio_or_checkbox.attr("disabled","disabled");
				qa_box.append(radio_or_checkbox);
			}
			break;
		case '填空':
		case '问答':
			qa_box.append($("<textarea name='qa'></textarea>").val(qa));
			break;	
	}
	$(".m-details div.qc textarea").val(qc);
}

function copy_record_from_list_to_details(obj){
	var currentRow = $(obj).parent().siblings("td"); // 当前数据行
	for(var i=0;i<currentRow.size();i++)
	{
		var sTd = currentRow.eq(i);
		var fn = sTd.attr("class");
		var fv = sTd.text();
		var tTd = ".m-details td[name='" + fn + "']";
		tTd = $(tTd);
		var inputs = tTd.children(':input');// text areatext select radio checkbox
		set_form_field_value(inputs,fv);
	}
}

// 设定表单字段的值
function set_form_field_value(inputs,value){
	if(inputs.is(":text,textarea,select")) // text textarea select
	{
		inputs.val(value);
	}
	else // radio checkbox
	{
		for(var i=0;i<inputs.size();i++)
		{
			var input = inputs.eq(i);
			if(value.charAt(i)=='1')
			{
				input.attr("checked",true);
			}
			else
			{
				input.attr("checked",false);
			}
		}
	}
}
// 从表单中获取名值对
function get_n2vs_from_form(form_f_boxs)
{
	var n2vs='';
	for(var i=0;i<form_f_boxs.size();i++)
	{
		var form_f_box = form_f_boxs.eq(i);
		var n = form_f_box.children(":input").eq(0).attr("name");
		var v = $.trim(get_form_field_value(form_f_box));
		if(regs[n]!=null)// 正则检查会抛出异常
		{
			reg_check(regs[n],v); 
		}
		n2vs+=('&'+n+'=' + encodeURIComponent(v));
	}
	return n2vs;
}
// 获取表单字段的值
function get_form_field_value(field_box){
	var v = '';
	var oIps = field_box.children(":input");
	if(oIps.is(":text,textarea,select")) // text textarea select
	{
		v = oIps.eq(0).val();
	}
	else
	{
		for(var i=0;i<oIps.size();i++) // radio checkbox
		{
			v += ((true==oIps.eq(i).is(":checked"))?1:0);
		}
	}
	return v;
}
// 构建查询条件 在查询栏中增加隐藏字段，对应不同的题型
function build_query_criteria(oIpts)
{
	var criteria='';
	for(var i=0;i<oIpts.size();i++)
	{
		var oIpt = oIpts.eq(i);
		var fn = oIpt.attr('name');
		var fv= $.trim(oIpt.attr('value'));
		
		if(oIpt.hasClass('check')){
			reg_check(regs[fn],fv);
		}

		if(fv!='')
		{
			criteria+=(fn+'='+encodeURIComponent(fv)+'&');
		}
	}
	return criteria;
}

// 显示分页条
function display_paging_bar(sumRows){
	var maxPageNo=Math.ceil(sumRows/pageSize)-1;
	$("#maxPageNo").text(maxPageNo);
	if(maxPageNo>0)
	{
		$(".m-pgbar").show();
	}
	else
	{
		$(".m-pgbar").hide();
	}
}