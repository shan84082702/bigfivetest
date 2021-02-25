<?php
	require_once 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php';
	header("Content-Type: application/vnd.ms-excel; charset=UTF-8 ");
	$objPHPExcel = new PHPExcel();
	
	//文字
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	$sql="select post_data_100.uid as uid, post_data_100.user_name as user_name, post_data_100.email as email, post_data_100.post_id as post_id, post_data_100.type as type, 
	post_data_100.message as message, post_data_100.pic_url as pic_url, post_data_100.post_time as post_time, post_data_100.post_url as post_url, post_data_100.privacy as privacy, 
	post_emo.surprise, post_emo.anticipation, post_emo.joy, post_emo.sad, 
	post_emo.disgust, post_emo.trust, post_emo.angry, post_emo.fear, post_emo.total, post_emo.haveresult, 
	userData.j1, userData.j2, userData.j3, userData.sa1, userData.sa2, userData.sa3, 
	userData.an1, userData.an2, userData.an3, userData.f1, userData.f2, userData.f3, 
	userData.su1, userData.su2, userData.su3, userData.ant1, userData.ant2, userData.ant3,
	userData.t1, userData.t2, userData.t3, userData.d1, userData.d2, userData.d3, userData.post_false 
	from post_data_100,post_emo,userData where post_data_100.post_id=post_emo.post_id and post_emo.post_id=userData.post_id;";
	$result=$connection->query($sql);
	$arr=array('使用者ID','名字','EMAIL','貼文ID', 'TYPE', '內容', 'PHOTO URL', 'TIME', '貼文URL', 'PRIVACY', 'suprise', 'anticipation', 'joy', 'sad', 'disgust', 'trust', 'angry', 'fear', 'total', 'HAVE EMOTION', 'j1', 'j2', 'j3', 'sa1', 'sa2', 'sa3', 'an1', 'an2', 'an3', 'f1', 'f2', 'f3', 'su1', 'su2', 'su3', 'ant1', 'ant2', 'ant3', 't1', 't2', 't3', 'd1', 'd2', 'd3', 'post_false');
	$objPHPExcel->getActiveSheet()->fromArray($arr);
	$i=0;
	while($row = $result->fetch_object()){
		$j=$i+2;
		
		//$msg = json_encode($row->message);
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$j,$row->uid)
					->setCellValue('B'.$j,$row->user_name)
					->setCellValue('C'.$j,$row->email)
					->setCellValue('D'.$j,$row->post_id)
					->setCellValue('E'.$j,$row->type)
					->setCellValue('F'.$j,$row->message)
					->setCellValue('G'.$j,$row->pic_url)
					->setCellValue('H'.$j,$row->post_time)
					->setCellValue('I'.$j,$row->post_url)
					->setCellValue('J'.$j,$row->privacy)
					->setCellValue('K'.$j,$row->surprise)
					->setCellValue('L'.$j,$row->anticipation)
					->setCellValue('M'.$j,$row->joy)
					->setCellValue('N'.$j,$row->sad)
					->setCellValue('O'.$j,$row->disgust)
					->setCellValue('P'.$j,$row->trust)
					->setCellValue('Q'.$j,$row->angry)
					->setCellValue('R'.$j,$row->fear)
					->setCellValue('S'.$j,$row->total)
					->setCellValue('T'.$j,$row->haveresult)
					->setCellValue('U'.$j,$row->j1)
					->setCellValue('V'.$j,$row->j2)
					->setCellValue('W'.$j,$row->j3)
					->setCellValue('X'.$j,$row->sa1)
					->setCellValue('Y'.$j,$row->sa2)
					->setCellValue('Z'.$j,$row->sa3)
					->setCellValue('AA'.$j,$row->an1)
					->setCellValue('AB'.$j,$row->an2)
					->setCellValue('AC'.$j,$row->an3)
					->setCellValue('AD'.$j,$row->f1)
					->setCellValue('AE'.$j,$row->f2)
					->setCellValue('AF'.$j,$row->f3)
					->setCellValue('AG'.$j,$row->su1)
					->setCellValue('AH'.$j,$row->su2)
					->setCellValue('AI'.$j,$row->su3)
					->setCellValue('AJ'.$j,$row->ant1)
					->setCellValue('AK'.$j,$row->ant2)
					->setCellValue('AL'.$j,$row->ant3)
					->setCellValue('AM'.$j,$row->t1)
					->setCellValue('AN'.$j,$row->t2)
					->setCellValue('AO'.$j,$row->t3)
					->setCellValue('AP'.$j,$row->d1)
					->setCellValue('AQ'.$j,$row->d2)
					->setCellValue('AR'.$j,$row->d3)
					->setCellValue('AS'.$j,$row->post_false);
		$i++;
	}
	$objPHPExcel->getActiveSheet()->setTitle('主客觀結果(文字)');
	
	//圖片
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(1);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');
	$objPHPExcel->getActiveSheet()->setTitle('主客觀結果(圖片)');
	
	//文字+圖片
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(2);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');
	$objPHPExcel->getActiveSheet()->setTitle('主客觀結果(圖片+文字)');
	
	//主客觀結果分析
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(3);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'More data');
	$objPHPExcel->getActiveSheet()->setTitle('受測者主客觀結果紀錄');


	//匯出成EXCEL
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="主客觀結果紀錄+分析.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
	$objWriter->save('php://output');
	
?>