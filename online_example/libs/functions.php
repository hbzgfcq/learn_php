<?php
function student_login_check($db,$username,$pwd){
	$student=null;
	$sql="select * from students where username='{$username}' and pwd='{$pwd}'";
	$student=$db->getRow($sql);
	if(!is_null($student))
	{
		$_SESSION['student']=$student['userID'];
		return true;
	}
	else
	{
		return false;
	}
}

function login_check($db,$username,$pwd){
	$user=null;
	$sql="select * from teachers where username='{$username}' and pwd='{$pwd}'";
	$user=$db->getRow($sql);
	if(!is_null($user))
	{
		$_SESSION['user']=$user;
		return true;
	}
	else
	{
		return false;
	}
}

function isAdmin(){
	global $db;
	$userID = $_SESSION['user']['userID'];
	$sql = "select count(*) from teachers where userID = '{$userID}' and isAdmin = '1'";

	if($db->getField($sql)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
} 

function output_menu($m_items){
	global $conf;
	$m_items=$conf['m_items'];
	foreach($m_items as $text=>$href)
	{
		echo "<li><a class=\"m-item\" href=\"{$href}\">{$text}</a></li>";
	}
}

function where($cols){
	$where='';
	foreach ($cols as $col){
		$col_value=(isset($_GET[$col])) ? trim($_GET[$col]):((isset($_POST[$col]))?trim($_POST[$col]):'');
		if($col_value!=''){
			$col_value = urldecode($col_value);
			
			if(!get_magic_quotes_gpc())
			{
				$col_value=addslashes($col_value);
			}
			
			if($where!='')
			{
				$where.= " and {$col}='{$col_value}'";
			}
			else
			{
				$where.=" where {$col}='{$col_value}'";
			}
		}
	}
	return $where;
}

function get_col_value_pairs($cols){
	$col_val_pairs = array();
	foreach ($cols as $col){
		$value = (isset($_POST[$col])) ? trim($_POST[$col]):'';
		if($value!=null)
		{
			$value = urldecode($value);
			if(!get_magic_quotes_gpc())
			{
				$value=addslashes($value);
			}
			$col_val_pairs[$col] = $value;
		}
	}
	return $col_val_pairs;
}

function get_sql_update_set_part($cols){
	$set="";
	$col_val_pairs=get_col_value_pairs($cols);
	foreach($col_val_pairs as $col=>$value)
	{
		$set.="{$col}='{$value}',";
	}
	$set=rtrim($set,',');
	return $set;
}

function get_sql_insert_values_part($cols){	
	$col_val_pairs=get_col_value_pairs($cols);
	$fields='';
	$values='';
	foreach ($col_val_pairs as $col=>$value)
	{
		if($fields=='')
		{
			$fields.="({$col}";
			$values.="('{$value}'";
		}
		else
		{
			$fields.=",{$col}";
			$values.=",'{$value}'";
		}
	}
	if($fields!='')
	{
		$fields.=')';
		$values.=')';
	}
	return $fields.' values '.$values;
}

// 数据库操作失败则返回错误信息字符串;结果集为空则返回空字符串;否则返回JSON数组形式的字符串，第一个元素是表格中的总行数
function R($dt,$where=''){
	global $db;
	$sql="select count(*) from {$dt} {$where}";
	$sumRows=$db->getField($sql);
	
	$pageNo=$_GET['pageNo'];
	$pageSize=$_GET['pageSize'];
	$start=$pageNo*$pageSize;
	$limit=" limit {$start},{$pageSize}";
	$sql="select * from {$dt} {$where} {$limit}";
	$rows=$db->getRows($sql);

	header("Content-type: text/html; charset=utf-8");
	if($rows!=null){
		$data = json_encode($rows);
		$data='[{sumRows:'.$sumRows.'}'.substr_replace($data,',',0,1);
		echo $data;
	}
}

function U($dt,$cols,$where){
	global $db;
	$set = get_sql_update_set_part($cols);
	$sql = "update {$dt} set {$set} {$where}";
	$db->U($sql);// 访问数据库失败会打印出错信息并终止
}

function C($dt,$cols){
	global $db;
	$values = get_sql_insert_values_part($cols);
	$sql = "insert into {$dt} {$values}";
	$db->C($sql);// 访问数据库失败会打印出错信息并终止
}

function D($dt,$where){
	global $db;
	$sql = "delete from {$dt} {$where}";
	$db->D($sql);// 访问数据库失败会打印出错信息并终止
}

function display_q($q){
	$qID = $q['qID'];
	$qType = $q['qType'];
	$question = $q['question'];
	$answer1 = $q['answer1'];
	$fenshu = $q['fenshu'];
	echo "<div class=\"q\">";
	echo "<input type=\"hidden\" name=\"qID\" class=\"qID\" value=\"{$qID}\"/>";
	echo "<div class=\"qo\"><span>{$fenshu}分</span></div>";
	echo "<div class=\"qb\">{$question}</div>";
	$type = 'radio';
	$alternations = array('A','B','C','D');
	if($answer1==''||$answer1==null)
	{
		$answer1=($qType=='判断')?'00':(($qType=='填空'||$qType=='问答')?'':'0000');
	}
	switch($qType)
	{
		case '填空':
		case '问答':
			echo "<div class=\"qa\"><textarea name=\"answer1\" class=\"answer1\">{$answer1}</textarea></div>";
			break;
		case '判断':
			$alternations = array('T','F');
		case '多选':
			$type = 'checkbox';
		case '单选':
			echo "<div class=\"qa\">";
			for($i=0;$i<count($alternations);$i++)
			{
				$alternation = $alternations[$i];
				echo "<span>{$alternation}</span>";
				$checked = (substr($answer1,$i,1)=='1')?'checked="checked"':'';
				echo "<input type=\"{$type}\" name=\"{$qID}\" value=\"{$alternation}\" {$checked}/>";
			}
			echo "</div>";
			break;
	}
	echo "<div class=\"qo\"><a class=\"saveAnswer\" href=\"javascript:void(0);\">保存</a></div>";
	echo "</div>";}

function display_details($row,$cols){
	global $conf;
	$col_settings=$conf['col_settings'];
	for ($i = 0;$i<count($cols);$i++){
		echo '<tr>';
		$col=$cols[$i];
		$col_setting = $col_settings[$col];
		echo '<td>'.$col_setting['label'].'</td>';
		echo '<td class="td_field">';
		$col_value = $row[$col];
		display_field($col,$col_setting,$col_value);
		echo '</td>';
		echo "<td class=\"td_oldValue\"><input type=\"hidden\" id=\"{$col}\" value=\"{$col_value}\" /></td>"; // 保存旧值的隐藏域
		echo '</tr>';
	}
	echo '<tr>';
	echo "<td colspan=\"2\"><div class=\"f-bar\">";
	echo "<a href=\"javascript:void(0);\" class=\"edit\">编辑</a>";
	echo "<a href=\"javascript:void(0);\" class=\"del\">删除</a>";
	echo "<a href=\"javascript:void(0);\" class=\"cancel\">取消</a>";
	echo "<a href=\"javascript:void(0);\" class=\"confirm\">提交</a>";
	echo "<a href=\"javascript:void(0);\" class=\"add\">新增</a>";
	echo "</div></td>";
	echo '</tr>';
}

function display_field($col,$col_setting,$col_value){
	$type=$col_setting['type'];
	$class=$col_setting['class'];
	switch ($type){
		case 'select' :
			break;
		case 'radio':
			$values=$col_setting['values'];
			$texts=$col_setting['texts'];
			for($i=0;$i<strlen($col_value);$i++){
				$value=$values[$i];
				$text=$texts[$i];
				$checked=($col_value[$i]==1)?'checked="checked"':'';
				echo "{$text} <input class=\"{$class}\" type=\"radio\" name=\"{$col}\" {$checked} value=\"{$value}\" disabled=\"disabled\" />";
			}
			break;
		case 'checkbox':
			$values=$col_setting['values'];
			$texts=$col_setting['texts'];
			for($i=0;$i<strlen($col_value);$i++){
				$value=$values[$i];
				$text=$texts[$i];
				$checked=($col_value[$i]==1)?'checked="checked"':'';
				echo "{$text} <input class=\"{$class}\" type=\"checkbox\" name=\"{$col}\" {$checked} value=\"{$value}\" disabled=\"disabled\" />";
			}
			break;
		case 'textarea':
			break;
		case 'text':
			echo "<input type=\"text\" class=\"{$class}\" value=\"{$col_value}\" name=\"{$col}\" disabled=\"disabled\" />";
	}
}
