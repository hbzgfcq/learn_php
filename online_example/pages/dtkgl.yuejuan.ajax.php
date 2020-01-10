<?php
$a=$_GET['a'];

switch($a){
	case 'yuejuan':
		{
			$where = where(array('examID','userID','qID'));
			U('answersheet',array('fenshu1','checked'),$where);
		}
}