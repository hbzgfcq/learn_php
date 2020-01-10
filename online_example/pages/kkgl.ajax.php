<?php
$a=$_GET['a'];

if($a=='C'||$a=='U')
{
	$yyyy = $_POST['yyyy'];
	$majoyName = $_POST['majoyName'];
	$sql = "select majoyID from majoys where yyyy='{$yyyy}' and majoyName='{$majoyName}'";
	if(!($majoyID = $db->getField($sql)))
	{
		$db->db_err("数据库中没这个专业");
	}
	$_POST['majoyID']=$majoyID;
	
	$courseName = $_POST['courseName'];
	$sql = "select courseID from courses where courseName = '{$courseName}'";
	if(!($courseID = $db->getField($sql)))
	{
		$db->db_err("数据库中没这门课程");
	}
	$_POST['courseID']=$courseID;
}

switch($a){
	case 'R':
		$where=where(array('yyyy','majoyName','term'));
		R('v_coursesettings',$where);
		break;
	case 'C':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$cols=array('majoyID','term','courseID');
		C('coursesettings',$cols);
		break;
	case 'U':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where=where(array('courseSettingID'));
		$cols=array('majoyID','term','courseID');
		U('coursesettings',$cols,$where);
		break;
	case 'D':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where=where(array('courseSettingID'));
		D('coursesettings',$where);
		break;
}