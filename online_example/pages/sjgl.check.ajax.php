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
			$where=where(array('examID','qType'));
			R('v_paper',$where);
			break;
		}
	case 'D':
		{
			if($exam['examState']=='已组卷')
			{
				$where=where(array('examID'));
				D('paper',$where);
				$sql = "update exams set examState='待组卷' where examID='{$examID}'";
				$db->U($sql);
				break;
			}
			else
			{
				$db->db_err('不能删除本次考试试卷');
			}
		}
}