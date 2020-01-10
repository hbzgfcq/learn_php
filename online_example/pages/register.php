<?php
$cols=array('userName','fullName','pwd');
C('teachers',$cols);
$db->db_err('注册成功了，请等待管理员审核');
