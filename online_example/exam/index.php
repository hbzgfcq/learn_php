<?php
session_start();
$conf=require('../conf.php');
require('../libs/functions.php');
require('../libs/classes.php');
$db=DBFactory::getDB();

$p=(isset($_GET['p']))? $_GET['p']:'exam';// 页面名

if($p=='register'||$p=='login.ajax')
{
	require("./".$p.".php");
	exit();
}

$app_name=$conf['app_name'];// 应用程序名显示于标题栏
$msg=null;// 从服务器返回的提示信息

if ( isset($_POST['userName']) && isset($_POST['pwd']) && isset($_POST['login']))
{
	//  如果用户尝试登陆则执行用户身份验证
	$userName=$_POST['userName'];
	$pwd=$_POST['pwd'];
	if(!student_login_check($db,$userName,$pwd))// 身份验证成功则创建会话变量并返回真值
	{
		$msg='账号信息错';
	}
}

if(isset($_SESSION['student'])){
	// 如果是通过身份验证的用户则显示页面
	require("./".$p.".php");
}
else{
	// 如果是未通过验证的用户则显示登陆页面
	require('./login.php');
}