<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $app_name?></title>
<script language="javascript" type="text/javascript" src="/js/jquery-1.7.2.js"></script>
<script language="javascript" type="text/javascript" src="/js/functions.js"></script>
<link href="/css/reset.css" rel="stylesheet" type="text/css" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<input type="hidden" id="pageName" name="pageName" value="<?php echo $p?>" />
<div class="g-doc">
	<div class="g-hd">
		<div class="logo-bar">Orange online exam system</div>
		<div class="login-bar"><b><?php echo $_SESSION['user']['fullName'];?></b>&nbsp;&nbsp;<a href="index.php?p=logout" style="color:#fff;"><b>-->[]</b></a></div>
		<div class="f-cb"></div>
	</div>
	<div class="g-nav">
		<ul class="u-s-nav"><?php output_menu($m_items);?></ul>
	</div>