<?php
$a=$_GET['a'];
if($a=='C'||$a=='U'||$a=='D')
{
	$courseID = $_POST['courseID'];
	$userID = $_SESSION['user']['userID'];
	$sql = "select count(*) from courses where head = '{$userID}' and courseID = '{$courseID}'";
	if($db->getField($sql)<1)
	{
		$db->db_err('你不是本课程的负责人，无权改动题库');
	}
}
switch($a){
	case 'R':
		$where=where(array('courseID','qType'));
		R('v_questions',$where);
		break;
	case 'C':
		$cols=array('courseID','qType','question','answer','cmt');
		C('questions',$cols);
		break;
	case 'U':
		$where=where(array('qID'));
		$cols=array('qID','question','answer','cmt');
		U('questions',$cols,$where);
		break;
	case 'D':
		$where=where(array('qID'));
		D('questions',$where);
		break;
}