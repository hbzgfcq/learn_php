<?php
$a=$_GET['a'];

switch($a){
	case 'R':
		$where=where(array('yyyy','majoyName','classNo'));
		R('v_students',$where);
		break;
	case 'C':
	case 'U':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		
		$where = where(array('yyyy','majoyName'));
		$sql = "select majoyID from majoys {$where}";
		if(!($majoyID=$db->getField($sql)))
		{
			$db->db_err('数据库中没这个专业');
		}
		$where = where(array('majoyID','classNo'));
		$sql = "select classID from classes {$where}";
		if(!($classID=$db->getField($sql)))
		{
			$db->db_err('数据库中没这个班');
		}
		$_POST['classID']=$classID;
		
		if($a=='C')
		{
			C('students',array('userName','classID','fullName','pwd'));
		}
		else if($a=='U')
		{
			$where=where(array('userID'));
			U('students',array('userName','classID','fullName','pwd'),$where);
		}
		
		break;
	case 'D':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where = where(array('userID'));
		D('students',$where);
		break;
}