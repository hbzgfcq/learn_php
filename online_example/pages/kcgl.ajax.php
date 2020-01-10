<?php
$a=$_GET['a'];

switch($a){
	case 'R':
		R('v_courses');
		break;

	case 'C':
	case 'U':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		
		$where = where(array('fullName'));
		$sql = "select userID from teachers {$where}";
		if(!($userID=$db->getField($sql)))
		{
			$db->db_err('数据库中没这个老师');
		}

		$_POST['head']=$userID;
		
		if($a=='C')
		{
			C('courses',array('courseName','head'));
		}
		else if($a=='U')
		{
			$where=where(array('courseID'));
			U('courses',array('courseName','head'),$where);
		}		
		break;
	
	case 'D':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where = where(array('courseID'));
		D('courses',$where);
		break;
}