<?php
$conf=array(
	'app_name'=>'橙子在线考试系统',
	'baseuri'=>__DIR__,
	'db'=>array(
		'dbms'=>'Mysql',
		'host'=>'127.0.0.1',
		'username'=>'root',
		'password'=>'fcq690914',
		'dbname'=>'oe'
	),
	'm_items'=>array(
			'专业管理'=>'index.php?p=zygl',
			'教师管理'=>'index.php?p=jsgl',
			'班级管理'=>'index.php?p=bjgl',
			'学生管理'=>'index.php?p=xsgl',
			'课程管理'=>'index.php?p=kcgl',
			'开课管理'=>'index.php?p=kkgl',
			'考试管理'=>'index.php?p=ksgl',
	),
);

return $conf;