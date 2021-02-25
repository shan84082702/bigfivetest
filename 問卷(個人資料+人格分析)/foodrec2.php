<?php session_start(); //開啟session的語法 要放在檔案最上方?>
<?php
$text="<p align='center' valign='middle'>每日一菜</p>";
echo $text;
header("Content-Type:text/html; charset=utf-8");

$MAX=0;
$userEmail=$_SESSION["userEmail"];
$post_num=array(0,0,0,0,0,0,0,0);
$pic_num=array(0,0,0,0,0,0,0,0);
$result_num=array(0,0,0,0,0,0,0,0);
/*$category=array("surprise","anticipation","joy","sad","disgust","trust","angry","fear"); //以斷詞ID排序
$food_category=array(5,6,1,2,8,7,3,4);//斷詞ID1-8 分別對應到的情緒*/
$connection=mysqli_connect("localhost","root","!QAZ@WSX","bigfivetest") or die("CONNECTION FAIL");
mysqli_set_charset ($connection,'utf8');
$sql="SELECT * FROM post_data WHERE email='$userEmail' ORDER BY post_time DESC LIMIT 1";
$result=$connection->query($sql);
$nums=mysqli_num_rows($result);
if($nums>0) //有發表文章
{
	$row=$result->fetch_object();
	$post_id=$row->post_id;
	
	$sql="SELECT * from post_emo where post_id='$post_id';";
	$result=$connection->query($sql);
	$nums=mysqli_num_rows($result);
	if($nums>0)
	{
		$row = $result->fetch_object();
		$post_num=array($row->surprise,$row->anticipation,$row->joy,$row->sad,$row->disgust,$row->trust,$row->angry,$row->fear);	
	}

	$sql="SELECT * from face_emotion where post_id='$post_id';";
	$result=$connection->query($sql);
	$nums=mysqli_num_rows($result);
	if($nums>0)
	{
		$row = $result->fetch_object();
		$pic_num=array($row->surprise,$row->anticipation,$row->happiness,$row->sadness,$row->disgust,$row->trust,$row->anger,$row->fear);	
	}
	for($i=0; $i<8; $i++){
		$result_num[$i]=$post_num[$i]+$pic_num[$i];
		//echo $result_num[$i]."<br>";
	}
	mysqli_close($connection);
	
	$MAX=array_search(max($result_num), $result_num);
	if($MAX==0 && $result_num[0]==0){
		result('2');
	}
	else{
		result($MAX);
	}	
}
else{
	result('2');
}

function result($M){
	$MAX=$M;
	$category=array("surprise","anticipation","joy","sad","disgust","trust","angry","fear");
	$food_category=array(5,6,1,2,8,7,3,4);
	echo "<script language=\"JavaScript\">confirm(\"今天心情\\n$category[$MAX]\");</script>";
	$FOOD_MAX=$MAX;
	$connection2=mysqli_connect("localhost","root","!QAZ@WSX","bigfivetest") or die("CONNECTION FAIL");
	$sql2="SELECT * from food where moodID='$food_category[$FOOD_MAX]' order by rand();";
	$result2=$connection2->query($sql2);
	$nums=0;
	while($row2 = $result2->fetch_object()){
		if($nums==0){
			echo "<div style='position:relative; text-align:center; width:100%;'> <img src=\"foodPhoto/".$row2->ID.".jpg\" width=\"100%\">
			<div style='position:absolute; top:40%; width:100%; color:#FFF; font-size:20px; font-weight:bolder;'> 
			TODAY'S SPECIAL<br>".$row2->Name." 
			</div><div style='position:relative; margin-top:-10%; width:100%; color:#FFF;' align='left'><img src=\"icons_300ppi/".$category[$MAX].".png\" width=\"10%\"></div></div><br>";

			$nums++;}
		else{
			if($nums==1)
				$text="<table border=0 width=100% style='table-layout:fixed'>";
			if($nums%2!=0)
				$text .="<tr>";
			$text .="<td align='center' valign='middle'><div style='position:relative;'><img src=\"foodPhoto/".$row2->ID.".jpg\" width=\"95%\">
			<div style='position:relative; margin-top:-18%; width:100%; color:#FFF;' align='left'><img src=\"icons_300ppi/".$category[$MAX].".png\" width=\"20%\"></div></div>".$row2->Name."</td>";
			if($nums%2==0)
				$text .="</tr>";
			$nums++;
		}
	}
	$text .="</table>";
	echo $text;

	mysqli_close($connection2);
}




?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" >
	</head> 
</html>