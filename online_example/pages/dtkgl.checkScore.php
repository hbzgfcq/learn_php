<?php
require('/PHPExcel/PHPExcel.php');
$dir=dirname(__DIR__);
$examID=$_GET['examID'];
$sql="select * from v_exams where examID='{$examID}'";
$exam=$db->getRow($sql);

// 分班获取成绩表
$sql="select distinct classNo from v_scores where examID='{$examID}' order by classNo";
$scoreTbs=array();
$classNos=$db->getCol($sql);
foreach($classNos as $classNo){
	$sql="select fullName,score from v_scores where examID='{$examID}' and classNo='{$classNo}'";
	$scoreTbs[$classNo]=$db->getRows($sql);
}
// 生成成绩表
$examName = $exam['yyyy'].'级'.$exam['majoyName'].'专业学期'.$exam['term'].$exam['courseName'].$exam['examType'].'考试';
$file_name=$dir."\\scoresheets\\".$examName.'成绩表.xlsx';
$file_name=iconv("utf-8","gb2312",$file_name);
if(!file_exists($file_name)){
	$excelBook=new PHPExcel();
	$i=0;
	foreach($scoreTbs as $classNo=>$scoreTb){
		if($i==0)
		{
			$excelSheet=$excelBook->getActiveSheet();		
		}
		else
		{
			$excelSheet=$excelBook->createSheet();
		}
		$excelSheet->setTitle($classNo.'班');
		$excelSheet->setCellValue('A1','姓名')->setCellValue('B1','分数');
		$j=2;
		foreach($scoreTb as $score){
			$excelSheet->setCellValue('A'.$j,$score['fullName'])->setCellValue('B'.$j,$score['score']);
			$j++;
		}
		$i++;
	}
	$excelWriter=PHPExcel_IOFactory::createWriter($excelBook,'excel2007');
	$excelWriter->save($file_name);
}

?>
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
	<style>
		body,.g-ft{background:#ccc;}
		.g-doc{background:#fff;position:relative;}
		.g-hd-1{padding:12px 0px 12px 8px;background:#eee;font-weight:bold;color:#303030;}
		.g-ft{height:150px;line-height:150px;}
		td.score_tb_box{vertical-align:top;text-align:left;padding:8px;}
		td.score_tb_box td{padding:4px;border:1px #ccc solid;font-weight:bold;color:#666;}
	</style>
</head>
<body>
	<div class="g-doc">
		<input type="hidden" id="pageName" name="pageName" value="<?php echo $p;?>" />
		<input type="hidden" id="examID" name="examID" value="<?php echo $examID;?>" />
		<div class="g-hd-1">
			<div>
				<?php echo $examName;?> —— 
				<a class='download' href="<?php echo "/scoresheets/$examName".'成绩表.xlsx';?>">分数表</a>
			</div>
		</div>
		<!--doc body-->
		<div class="g-md">
			<div class="g-content">
				<table>
					<tr>
						<?php
							foreach ($classNos as $classNo)
							{
								echo "<td class='score_tb_box'>";
								echo "<div><table>";
								echo "<tr><td colspan=\"2\" style=\"text-align:center;color:blue;\">{$classNo}班</td></tr>";
								echo '<tr><td>姓名</td><td>成绩</td></tr>';
								$scoreTb = $scoreTbs[$classNo];
								foreach ($scoreTb as $score)
								{
									echo "<tr><td>".$score['fullName']."</td><td>".$score['score']."</td></tr>";
								}
								echo '</div></table>';
								echo '</td>';
							}
						?>
					</tr>
				</table>
			</div>
		</div>
		<div class="g-ft">
			<b>Copyright © 2015 Orange.com All Rights Reserved</b>
		</div>
	</div>
</body>
</html>