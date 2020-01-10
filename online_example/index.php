<?php
session_start();
$conf=require('conf.php');
require('/libs/functions.php');
require('/libs/classes.php');
$db=DBFactory::getDB();

$p=(isset($_GET['p']))? $_GET['p']:'zygl';// 页面名
if($p=='register')
{
	require('/pages/register.php');
	exit();
}
// 以下为页面显示所需的数据
$app_name=$conf['app_name'];// 应用程序名显示于标题栏
$m_items=$conf['m_items'];// 导航栏数据
$user=null;// 用户信息数据
$msg=null;// 从服务器返回的提示信息

if ( isset($_POST['userName']) && isset($_POST['pwd']) && isset($_POST['login']))
{
	//  如果用户尝试登陆则执行用户身份验证
	$userName=$_POST['userName'];
	$pwd=$_POST['pwd'];
	if(!login_check($db,$userName,$pwd))// 身份验证成功则创建会话变量并返回真值
	{
		$msg='账 号 信 息 错';
	}
}

if(isset($_SESSION['user'])){
	// 如果是合法的用户则显示页面
	require("/pages/".$p.".php");
}
else{
	// 如果是非法用户则显示登陆页面
	require('/pages/login.php');
}
