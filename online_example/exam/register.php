<?php
$yyyy=$_POST['yyyy'];
$majoyName=$_POST['majoyName'];
$classNo=$_POST['classNo'];
$userName=$_POST['userName'];
$fullName=$_POST['fullName'];
$pwd=$_POST['pwd'];
$studentNo=$_POST['studentNo'];
$sql = "select classID from v_classes where yyyy='{$yyyy}' and majoyName='$majoyName' and classNo='$classNo'";
if(!($classID = $db->getField($sql)))
{
	$db->db_err('没有这个班啊');
}
$sql =  "insert into students (classID,userName,fullName,studentNo,pwd) values('{$classID}','{$userName}','{$fullName}','{$studentNo}','{$pwd}')";
$db->C($sql);
$db->db_err('注册成功了，请等待管理员审核');
