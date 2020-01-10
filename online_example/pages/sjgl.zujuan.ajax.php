<?php
$examID = $_GET['examID'];
$userID = $_SESSION['user']['userID'];
$sql="select * from v_exams where examID='{$examID}' and testbuilder = '{$userID}'";
if(!($exam = $db->getRow($sql)))
{
	$db->db_err('你非本次考试的制卷人无操作权限');
}

$a=$_GET['a'];

switch($a)
{
	case 'R':
		{
			$_POST['courseID'] = $exam['courseID'];
			$where=where(array('courseID','qType'));
			R('v_questions',$where);
			break;
		}
	case 'C':
		if($exam['examState']=='待组卷')
		{
			$sql = "delete from paper where examID = '{$examID}'";
			$db->D($sql);
			$id_c_s = $_POST['id_c_s'];
			$arr_id_c = explode(',',$id_c_s);
			for($i=0;$i<count($arr_id_c);$i++)
			{
				$id_c = explode(':',$arr_id_c[$i]);
				$qID = $id_c[0];
				$fenshu = $id_c[1];
				$sql = "insert into paper (examID,qID,fenshu) values ('{$examID}','{$qID}','{$fenshu}')";
				$db->C($sql);
			}
			$sql = "update exams set examState = '已组卷' where examID = '{$examID}'";
			$db->U($sql);
			break;
		}
}