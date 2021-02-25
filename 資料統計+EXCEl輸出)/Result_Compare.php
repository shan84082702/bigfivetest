<?php
	require_once 'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php';
	header("Content-Type:text/html; charset=utf-8");
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
		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$j,$row->uid)
					->setCellValue('B'.$j,$row->user_name)
					->setCellValue('C'.$j,$row->email)
					->setCellValue('D'.$j,$row->post_id)
					->setCellValue('E'.$j,$row->type)
					//->setCellValue('F'.$j,$row->message)
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
	$sql="select post_data_100.uid as uid, post_data_100.user_name as user_name, post_data_100.email as email, 
	post_data_100.post_id as post_id, post_data_100.type as type, post_data_100.message as message, post_data_100.pic_url as pic_url, 
	post_data_100.post_time as post_time, post_data_100.post_url as post_url, post_data_100.privacy as privacy, 
	face_emotion.anger, face_emotion.disgust, face_emotion.fear, face_emotion.happiness, 
	face_emotion.sadness, face_emotion.surprise, face_emotion.anticipation, face_emotion.trust, 
	face_emotion.contempt, face_emotion.neutral, face_emotion.haveresult, 
	userData.j1, userData.j2, userData.j3, userData.sa1, userData.sa2, userData.sa3, 
	userData.an1, userData.an2, userData.an3, userData.f1, userData.f2, userData.f3, 
	userData.su1, userData.su2, userData.su3, userData.ant1, userData.ant2, userData.ant3, 
	userData.t1, userData.t2, userData.t3, userData.d1, userData.d2, userData.d3, userData.post_false 
	from post_data_100,face_emotion,userData where post_data_100.post_id=face_emotion.post_id and face_emotion.post_id=userData.post_id;";
	$result=$connection->query($sql);
	$arr2=array('使用者ID','名字','EMAIL','貼文ID', 'TYPE', '內容', 'PHOTO URL', 'TIME', '貼文URL', 'PRIVACY', 'anger', 'disgust', 'fear', 'happiness', 'sadness', 'surprise', 'anticipation', 'trust', 'contempt', 'neutral', 'have emotion', 'j1', 'j2', 'j3', 'sa1', 'sa2', 'sa3', 'an1', 'an2', 'an3', 'f1', 'f2', 'f3', 'su1', 'su2', 'su3', 'ant1', 'ant2', 'ant3', 't1', 't2', 't3', 'd1', 'd2', 'd3', 'post_false');
	$objPHPExcel->getActiveSheet()->fromArray($arr2);
	$i=0;
	while($row = $result->fetch_object()){
		$j=$i+2;
		
		$objPHPExcel->setActiveSheetIndex(1)
					->setCellValue('A'.$j,$row->uid)
					->setCellValue('B'.$j,$row->user_name)
					->setCellValue('C'.$j,$row->email)
					->setCellValue('D'.$j,$row->post_id)
					->setCellValue('E'.$j,$row->type)
					//->setCellValue('F'.$j,$row->message)
					->setCellValue('G'.$j,$row->pic_url)
					->setCellValue('H'.$j,$row->post_time)
					->setCellValue('I'.$j,$row->post_url)
					->setCellValue('J'.$j,$row->privacy)
					->setCellValue('K'.$j,$row->anger)
					->setCellValue('L'.$j,$row->disgust)
					->setCellValue('M'.$j,$row->fear)
					->setCellValue('N'.$j,$row->happiness)
					->setCellValue('O'.$j,$row->sadness)
					->setCellValue('P'.$j,$row->surprise)
					->setCellValue('Q'.$j,$row->anticipation)
					->setCellValue('R'.$j,$row->trust)
					->setCellValue('S'.$j,$row->contempt)
					->setCellValue('T'.$j,$row->neutral)
					->setCellValue('U'.$j,$row->haveresult)
					->setCellValue('V'.$j,$row->j1)
					->setCellValue('W'.$j,$row->j2)
					->setCellValue('X'.$j,$row->j3)
					->setCellValue('Y'.$j,$row->sa1)
					->setCellValue('Z'.$j,$row->sa2)
					->setCellValue('AA'.$j,$row->sa3)
					->setCellValue('AB'.$j,$row->an1)
					->setCellValue('AC'.$j,$row->an2)
					->setCellValue('AD'.$j,$row->an3)
					->setCellValue('AE'.$j,$row->f1)
					->setCellValue('AF'.$j,$row->f2)
					->setCellValue('AG'.$j,$row->f3)
					->setCellValue('AH'.$j,$row->su1)
					->setCellValue('AI'.$j,$row->su2)
					->setCellValue('AJ'.$j,$row->su3)
					->setCellValue('AK'.$j,$row->ant1)
					->setCellValue('AL'.$j,$row->ant2)
					->setCellValue('AM'.$j,$row->ant3)
					->setCellValue('AN'.$j,$row->t1)
					->setCellValue('AO'.$j,$row->t2)
					->setCellValue('AP'.$j,$row->t3)
					->setCellValue('AQ'.$j,$row->d1)
					->setCellValue('AR'.$j,$row->d2)
					->setCellValue('AS'.$j,$row->d3)
					->setCellValue('AT'.$j,$row->post_false);
		$i++;
	}
	$objPHPExcel->getActiveSheet()->setTitle('主客觀結果(圖片)');
	
	//文字+圖片
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(2);
	$sql="select post_data_100.uid as uid, post_data_100.user_name as user_name, post_data_100.email as email, 
	post_data_100.post_id as post_id, post_data_100.type as type, post_data_100.message as message, post_data_100.pic_url as pic_url, 
	post_data_100.post_time as post_time, post_data_100.post_url as post_url, post_data_100.privacy as privacy, 
	post_emo.surprise as post_surprise, post_emo.anticipation as post_anticipation, post_emo.joy as post_joy, post_emo.sad as post_sad, 
	post_emo.disgust as post_disgust, post_emo.trust as post_trust, post_emo.angry as post_angry, post_emo.fear as post_fear, 
	post_emo.total as post_total, post_emo.haveresult as post_haveresult, 
	face_emotion.anger as pic_anger, face_emotion.disgust as pic_disgust, face_emotion.fear as pic_fear, face_emotion.happiness as pic_happiness, 
	face_emotion.sadness as pic_sadness, face_emotion.surprise as pic_surprise, face_emotion.anticipation as pic_anticipation, face_emotion.trust as pic_trust, 
	face_emotion.contempt as pic_contempt, face_emotion.neutral as pic_neutral, face_emotion.haveresult as pic_haveresult, 
	userData.j1, userData.j2, userData.j3, userData.sa1, userData.sa2, userData.sa3, 
	userData.an1, userData.an2, userData.an3, userData.f1, userData.f2, userData.f3, 
	userData.su1, userData.su2, userData.su3, userData.ant1, userData.ant2, userData.ant3, 
	userData.t1, userData.t2, userData.t3, userData.d1, userData.d2, userData.d3, userData.post_false 
	from post_data_100,post_emo,face_emotion,userData 
	where post_data_100.post_id=post_emo.post_id and post_emo.post_id=face_emotion.post_id and face_emotion.post_id=userData.post_id";
	$result=$connection->query($sql);
	$arr3=array('使用者ID','名字','EMAIL','貼文ID', 'TYPE', '內容', 'PHOTO URL', 'TIME', '貼文URL', 'PRIVACY', 'suprise', 'anticipation', 'joy', 'sad', 'disgust', 'trust', 'angry', 'fear', 'total', 'HAVE EMOTION', 'anger', 'disgust', 'fear', 'happiness', 'sadness', 'surprise', 'anticipation', 'trust', 'contempt', 'neutral', 'have emotion', 'j1', 'j2', 'j3', 'sa1', 'sa2', 'sa3', 'an1', 'an2', 'an3', 'f1', 'f2', 'f3', 'su1', 'su2', 'su3', 'ant1', 'ant2', 'ant3', 't1', 't2', 't3', 'd1', 'd2', 'd3', 'post_false');
	$objPHPExcel->getActiveSheet()->fromArray($arr3);
	$i=0;
	while($row = $result->fetch_object()){
		$j=$i+2;
		
		$objPHPExcel->setActiveSheetIndex(2)
					->setCellValue('A'.$j,$row->uid)
					->setCellValue('B'.$j,$row->user_name)
					->setCellValue('C'.$j,$row->email)
					->setCellValue('D'.$j,$row->post_id)
					->setCellValue('E'.$j,$row->type)
					//->setCellValue('F'.$j,$row->message)
					->setCellValue('G'.$j,$row->pic_url)
					->setCellValue('H'.$j,$row->post_time)
					->setCellValue('I'.$j,$row->post_url)
					->setCellValue('J'.$j,$row->privacy)
					->setCellValue('K'.$j,$row->post_surprise)
					->setCellValue('L'.$j,$row->post_anticipation)
					->setCellValue('M'.$j,$row->post_joy)
					->setCellValue('N'.$j,$row->post_sad)
					->setCellValue('O'.$j,$row->post_disgust)
					->setCellValue('P'.$j,$row->post_trust)
					->setCellValue('Q'.$j,$row->post_angry)
					->setCellValue('R'.$j,$row->post_fear)
					->setCellValue('S'.$j,$row->post_total)
					->setCellValue('T'.$j,$row->post_haveresult)
					->setCellValue('U'.$j,$row->pic_anger)
					->setCellValue('V'.$j,$row->pic_disgust)
					->setCellValue('W'.$j,$row->pic_fear)
					->setCellValue('X'.$j,$row->pic_happiness)
					->setCellValue('Y'.$j,$row->pic_sadness)
					->setCellValue('Z'.$j,$row->pic_surprise)
					->setCellValue('AA'.$j,$row->pic_anticipation)
					->setCellValue('AB'.$j,$row->pic_trust)
					->setCellValue('AC'.$j,$row->pic_contempt)
					->setCellValue('AD'.$j,$row->pic_neutral)
					->setCellValue('AE'.$j,$row->pic_haveresult)
					->setCellValue('AF'.$j,$row->j1)
					->setCellValue('AG'.$j,$row->j2)
					->setCellValue('AH'.$j,$row->j3)
					->setCellValue('AI'.$j,$row->sa1)
					->setCellValue('AJ'.$j,$row->sa2)
					->setCellValue('AK'.$j,$row->sa3)
					->setCellValue('AL'.$j,$row->an1)
					->setCellValue('AM'.$j,$row->an2)
					->setCellValue('AN'.$j,$row->an3)
					->setCellValue('AO'.$j,$row->f1)
					->setCellValue('AP'.$j,$row->f2)
					->setCellValue('AQ'.$j,$row->f3)
					->setCellValue('AR'.$j,$row->su1)
					->setCellValue('AS'.$j,$row->su2)
					->setCellValue('AT'.$j,$row->su3)
					->setCellValue('AU'.$j,$row->ant1)
					->setCellValue('AV'.$j,$row->ant2)
					->setCellValue('AW'.$j,$row->ant3)
					->setCellValue('AX'.$j,$row->t1)
					->setCellValue('AY'.$j,$row->t2)
					->setCellValue('AZ'.$j,$row->t3)
					->setCellValue('BA'.$j,$row->d1)
					->setCellValue('BB'.$j,$row->d2)
					->setCellValue('BC'.$j,$row->d3)
					->setCellValue('BD'.$j,$row->post_false);
		$i++;
	}
	$objPHPExcel->getActiveSheet()->setTitle('主客觀結果(圖片+文字)');
	
	//主客觀結果分析
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(3);
	$arr4=array('使用者ID','名字','EMAIL','s_Text', 's_Photo', 's_T&P', 'S_Total');
	$objPHPExcel->getActiveSheet()->fromArray($arr4);
	$sql="SELECT distinct(uid) FROM userData WHERE 1;";
	$result=$connection->query($sql);
	$num=mysqli_num_rows($result);
	$i=0;
	$userID=array();
	$userName=array();
	$userEmail=array();
	while($row = $result->fetch_object()){
		$userID[$i]=$row->uid;
		$i++;
	}
	
	for($i=0; $i<$num; $i++){
		//名字+EMAIL
		$sql2="SELECT `user_name`, `email` FROM `post_data_100` WHERE `uid`='$userID[$i]'";
		$result2=$connection->query($sql2);
		while($row = $result2->fetch_object()){
			$userName[$i]=$row->user_name;
			$userEmail[$i]=$row->email;
		}
		
		//統計文字
		$sql3="select userData.post_id from post_emo,userData where post_emo.post_id=userData.post_id and post_emo.haveresult=1 and userData.haveresult=1 and userData.uid='$userID[$i]';";
		$result3=$connection->query($sql3);
		$num_text=mysqli_num_rows($result3);
		
		//統計圖片
		$sql4="select userData.post_id from face_emotion,userData where face_emotion.post_id=userData.post_id and face_emotion.haveresult=1 and userData.haveresult=1 and userData.uid='$userID[$i]';";
		$result4=$connection->query($sql4);
		$num_photo=mysqli_num_rows($result4);
		
		//統計圖片+文章
		$sql5="select userData.post_id from post_emo,face_emotion,userData where face_emotion.post_id=userData.post_id and post_emo.post_id=userData.post_id and face_emotion.haveresult=1 and userData.haveresult=1 and post_emo.haveresult=1 and userData.uid='$userID[$i]';";
		$result5=$connection->query($sql5);
		$num_TP=mysqli_num_rows($result5);
		
		$num_total=$num_text+$num_photo-$num_TP;
		
		$j=$i+2;
		$objPHPExcel->setActiveSheetIndex(3)
					->setCellValue('A'.$j,$userID[$i])
					->setCellValue('B'.$j,$userName[$i])
					->setCellValue('C'.$j,$userEmail[$i])
					->setCellValue('D'.$j,$num_text)
					->setCellValue('E'.$j,$num_photo)
					->setCellValue('F'.$j,$num_TP)
					->setCellValue('G'.$j,$num_total);
	}
	$objPHPExcel->getActiveSheet()->setTitle('受測者主客觀結果紀錄');


	//匯出成EXCEL
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="主客觀結果紀錄+分析.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	
?>