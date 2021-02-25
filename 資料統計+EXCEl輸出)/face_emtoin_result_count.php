<?php
	header("Content-Type:text/html; charset=utf-8");
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	$sql="SELECT `post_id`, `anger`, `disgust`, `fear`, `happiness`, `sadness`, `surprise`, `anticipation`, `trust`, `contempt`, `neutral`, `noface` FROM `face_emotion` WHERE 1;";
	$result=$connection->query($sql);
	while($row = $result->fetch_object()){
		if($row->anger>0 || $row->disgust>0 || $row->fear>0 || $row->happiness>0 || $row->sadness>0 || $row->surprise>0 || $row->anticipation>0 || $row->trust>0 || $row->contempt>0 || $row->neutral>0)
		{
			$postid=$row->post_id;
			$sql2="UPDATE `face_emotion` SET `haveresult`='1' WHERE `post_id`='$postid';";
			$result2=$connection->query($sql2);
		}	
	}
	
	$sql3="SELECT * FROM `userData` WHERE 1;";
	$result3=$connection->query($sql3);
	while($row = $result3->fetch_object()){
		if($row->j1>0||$row->j2>0||$row->j3>0||$row->sa1>0||$row->sa2>0||$row->sa3>0||$row->an1>0||$row->an2>0||$row->an3>0||$row->f1>0||$row->f2>0||$row->f3>0||$row->su1>0||$row->su2>0||$row->su3>0||$row->ant1>0||$row->ant2>0||$row->ant3>0||$row->t1>0||$row->t2>0||$row->t3>0||$row->d1>0||$row->d2>0||$row->d3>0)
		{
			$postid=$row->post_id;
			$sql4="UPDATE `userData` SET `haveresult`='1' WHERE `post_id`='$postid';";
			$result4=$connection->query($sql4);
		}	
	}
?>