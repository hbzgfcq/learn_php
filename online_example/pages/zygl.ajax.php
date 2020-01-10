<?php
$a=$_GET['a'];
switch($a){
	case 'R':
		$where=where(array('yyyy','majoyName'));
		R('majoys',$where);
		break;
	case 'C':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$cols=array('yyyy','majoyName','schooling');
		C('majoys',$cols);
		break;
	case 'U':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where=where(array('majoyID'));
		$cols=array('yyyy','majoyName','schooling');
		U('majoys',$cols,$where);
		break;
	case 'D':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$where=where(array('majoyID'));
		D('majoys',$where);
		break;
}