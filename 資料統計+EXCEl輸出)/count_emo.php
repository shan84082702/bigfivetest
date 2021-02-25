<?php
	header("Content-Type:text/html; charset=utf-8");
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:filename=情緒統計.xls");
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	$sql="SELECT distinct(uid), user_name FROM post_data_100 WHERE 1;";
	$result=$connection->query($sql);
	$num=mysqli_num_rows($result);
	$i=0;
	$userID=array();
	$userName=array();
	$content="ID\tName\tpost_start\tpost_end\tT_surprise\tT_anticipation\tT_joy\tT_sad\tT_disgust\tT_trust\tT_angry\tT_fear\tT_total\tN_surprise\tN_anticipation\tN_joy\tN_sad\tN_disgust\tN_trust\tN_angry\tN_fear\tN_total\tF_anger\tF_disgust\tF_fear\tF_happiness\tF_sadness\tF_surprise\tF_anticipation\tF_trust\tF_contempt\tF_neutra\tF_total\tP_anger\tP_disgust\tP_fear\tP_happiness\tP_sadness\tP_surprise\tP_anticipation\tP_trust\tP_contempt\tP_neutra\tP_total\tT&F_surprise\tT&F_anticipation\tT&F_joy\tT&F_sad\tT&F_disgust\tT&F_trust\tT&F_angry\tT&F_fear\tT&F_contempt\tT&F_neutral\tT&F_total\n";


	while($row = $result->fetch_object()){
		$userID[$i]=$row->uid;
		$userName[$i]=$row->user_name;
		$i++;
	}
	
	for($i=0; $i<$num; $i++){
		//第一篇貼文和最後一篇貼文的時間
		$sql2="SELECT min(`post_time`) as post_start, max(`post_time`) as post_end FROM `post_data_100` WHERE uid='$userID[$i]'";
		$result2=$connection->query($sql2);
		$post_start=$post_end=0;
		while($row = $result2->fetch_object()){
			$post_start=$row->post_start;
			$post_end=$row->post_end;
		}
		
		//統計文章情緒
		$N_num_only1=array(0,0,0,0,0,0,0,0,0);
		$N_num=array(0,0,0,0,0,0,0,0,0);
		$T_num=array(0,0,0,0,0,0,0,0,0);
		$sql3="SELECT `surprise`, `anticipation`, `joy`, `sad`, `disgust`, `trust`, `angry`, `fear`, `total` FROM `post_emo` WHERE `uid`='$userID[$i]'";
		$result3=$connection->query($sql3);
		while($row = $result3->fetch_object()){
			$N_num_only1[0]=$row->surprise;
			$N_num_only1[1]=$row->anticipation;
			$N_num_only1[2]=$row->joy;
			$N_num_only1[3]=$row->sad;
			$N_num_only1[4]=$row->disgust;
			$N_num_only1[5]=$row->trust;
			$N_num_only1[6]=$row->angry;
			$N_num_only1[7]=$row->fear;
			$N_num_only1[8]=$row->total;
			for($j=0; $j<=8; $j++){
				if($N_num_only1[$j]>0){
					$N_num[$j]+=$N_num_only1[$j];
					$T_num[$j]++;
				}	
			}
		}
		
		//統計圖片
		$P_num_only1=array(0,0,0,0,0,0,0,0,0,0);
		$P_num=array(0,0,0,0,0,0,0,0,0,0,0);
		$F_num=array(0,0,0,0,0,0,0,0,0,0,0);
		$sql4="SELECT `anger`, `disgust`, `fear`, `happiness`, `sadness`, `surprise`, `anticipation`, `trust`, `contempt`, `neutral`, `noface` FROM `face_emotion` WHERE `uid`='$userID[$i]'";
		$result4=$connection->query($sql4);
		while($row = $result4->fetch_object()){
			$P_num_only1[0]=$row->anger;
			$P_num_only1[1]=$row->disgust;
			$P_num_only1[2]=$row->fear;
			$P_num_only1[3]=$row->happiness;
			$P_num_only1[4]=$row->sadness;
			$P_num_only1[5]=$row->surprise;
			$P_num_only1[6]=$row->anticipation;
			$P_num_only1[7]=$row->trust;
			$P_num_only1[8]=$row->contempt;
			$P_num_only1[9]=$row->neutral;
			$count=0; //統計總篇數用
			for($j=0; $j<=9; $j++){
				if($P_num_only1[$j]>0){
					if($count==0){
						$F_num[10]++;
						$count=1;
					}
					$P_num[$j]+=$P_num_only1[$j];
					$P_num[10]+=$P_num_only1[$j];
					$F_num[$j]++;
				}	
			}
		}
		
		//統計圖片+文章
		$TF_T_num=array(0,0,0,0,0,0);
		$TF_F_num=array(0,0,0,0,0,0);
		$TF_num=array(0,0,0,0,0,0,0);
		$sql5="select face_emotion.surprise as F_surprise, face_emotion.happiness as F_joy, face_emotion.sadness as F_sad, 
		face_emotion.disgust as F_disgust, face_emotion.anger as F_angry, face_emotion.fear as F_fear, 
		post_emo.surprise as P_surprise, post_emo.joy as P_joy, post_emo.sad as P_sad, 
		post_emo.disgust as P_disgust, post_emo.angry as P_angry, post_emo.fear as P_fear 
		FROM face_emotion, post_emo 
		WHERE face_emotion.post_id=post_emo.post_id and face_emotion.uid='$userID[$i]'";
		$result5=$connection->query($sql5);
		while($row = $result5->fetch_object()){
			$TF_F_num[0]=$row->F_surprise;
			$TF_F_num[1]=$row->F_joy;
			$TF_F_num[2]=$row->F_sad;
			$TF_F_num[3]=$row->F_disgust;
			$TF_F_num[4]=$row->F_angry;
			$TF_F_num[5]=$row->F_fear;
			$TF_T_num[0]=$row->P_surprise;
			$TF_T_num[1]=$row->P_joy;
			$TF_T_num[2]=$row->P_sad;
			$TF_T_num[3]=$row->P_disgust;
			$TF_T_num[4]=$row->P_angry;
			$TF_T_num[5]=$row->P_fear;
			$count=0;
			for($j=0; $j<6; $j++){
				if($TF_F_num[$j]>0 && $TF_T_num[$j]>0){
					if($count==0){
						$TF_num[6]++;
						$count=1;
					}
					$TF_num[$j]++;
				}	
			}
		}
		$content.="$userID[$i]\t$userName[$i]\t$post_start\t$post_end\t$T_num[0]\t$T_num[1]\t$T_num[2]\t$T_num[3]\t$T_num[4]\t$T_num[5]\t$T_num[6]\t$T_num[7]\t$T_num[8]\t$N_num[0]\t$N_num[1]\t$N_num[2]\t$N_num[3]\t$N_num[4]\t$N_num[5]\t$N_num[6]\t$N_num[7]\t$N_num[8]\t$F_num[0]\t$F_num[1]\t$F_num[2]\t$F_num[3]\t$F_num[4]\t$F_num[5]\t$F_num[6]\t$F_num[7]\t$F_num[8]\t$F_num[9]\t$F_num[10]\t$P_num[0]\t$P_num[1]\t$P_num[2]\t$P_num[3]\t$P_num[4]\t$P_num[5]\t$P_num[6]\t$P_num[7]\t$P_num[8]\t$P_num[9]\t$P_num[10]\t$TF_num[0]\t0\t$TF_num[1]\t$TF_num[2]\t$TF_num[3]\t0\t$TF_num[4]\t$TF_num[5]\t0\t0\t$TF_num[6]\n";
	}
	
	$content = mb_convert_encoding($content , "Big5" , "UTF-8");
	echo $content;
	exit;

?>