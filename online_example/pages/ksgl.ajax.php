<?php
$a=$_GET['a'];
switch($a){
	case 'R':
		$where=where(array('yyyy','majoyName','term'));
		R('v_exams',$where);
		break;
	case 'C':
		$fullName = $_POST['fullName'];
		$sql = "select userID from teachers where fullName='{$fullName}'";
		if(!($userID=$db->getField($sql)))
		{
			$db->db_err('数据库中没这个老师的信息！');
		}
		$_POST['testbuilder'] = $userID;
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$cols=array('courseSettingID','examType','testbuilder','howLong');
		C('exams',$cols);
		break;
	case 'D':
		if(!isAdmin())
		{
			$db->db_err('你没有管理员权限');
		}
		$_POST['examState']='待组卷';
		$where=where(array('examID','examState'));
		D('exams',$where);
		break;
	case 'start_exam':
		$examID = $_GET['examID'];
		$sql = "select * from v_exams where examID = '{$examID}'";
		$exam = $db->getRow($sql);
		// 参加本次考试的专业
		$majoyID = $exam['majoyID'];
		// 同一专业不能同时考两场
		$sql = "select * from v_exams where majoyID='{$majoyID}' and examState = '考试中'";
		if($db->getRows($sql))
		{
			$db->db_err('同一专业不能同时开考两场');
		}

		// 清空答题卡
		$sql="delete from answersheet where examID='{$examID}'";
		$db->D($sql);
		// 参加本次考试的考生ID
		$sql = "select userID from v_students where majoyID ='{$majoyID}'";
		$userIDs = $db->getCol($sql);
		// 生成答题卡
		foreach($userIDs as $userID)
		{
			// 本次考试的试卷中的试题
			$sql = "select qID from paper where examID = '{$examID}'";
			$qIDs = $db->getCol($sql);
			foreach ($qIDs as $qID)
			{
				$sql = "insert into answersheet (examID,userID,qID) values ('{$examID}','{$userID}','{$qID}')";
				$db->C($sql);
			}
		}
		// 修改考试状态为考试中并记录开考时间
		$howLong=$exam['howLong'];
		$timeOfEnd = date("Y-m-d H:i:s",(time()+$howLong*60));
		$sql = "update exams set examState='考试中',timeOfEnd='{$timeOfEnd}' where examID='{$examID}'";
		$db->U($sql);
		break;
	case 'stop_exam':
		$examID = $_GET['examID'];
		$sql = "update exams set examState='待阅卷' where examID='{$examID}'";
		$db->U($sql);
		break;
}