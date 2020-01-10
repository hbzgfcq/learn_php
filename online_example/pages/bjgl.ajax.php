<?php
$a=$_GET['a'];
switch($a){
	case 'R':
		$where=where(array('yyyy','majoyName'));
		R('v_classes',$where);
		break;
	
	case 'C':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		
		$where = where(array('yyyy','majoyName'));
		$sql = "select majoyID from majoys {$where}";
		
		if($majoyID=$db->getField($sql)) // null 0 false 都是假
		{
			$_POST['majoyID']=$majoyID;
			C('classes',array('majoyID','classNo'));
		}
		else
		{
			$db->db_err('该专业不存在');
		}
		break;
	
	case 'U':
		break;
	
	case 'D':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where=where(array('classID'));
		D('classes',$where);
		break;
}