<?php
$a=$_GET['a']; // Action = R? U? C? D?
switch($a){
	case 'R':
		R('teachers');
		break;
	case 'C':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$cols=array('userName','pwd','fullName','checked','isAdmin');
		C('teachers',$cols);
		break;
	case 'U':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where=where(array('userID'));
		$cols=array('userName','pwd','fullName','checked','isAdmin');
		U('teachers',$cols,$where);
		break;
	case 'D':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where=where(array('userID'));
		D('teachers',$where);
		break;
}