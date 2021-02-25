<?php
header("Content-Type:text/html; charset=utf-8");
ini_set('memory_limit', '1024M');

require_once "jieba-php-master/src/vendor/multi-array/MultiArray.php";
require_once "jieba-php-master/src/vendor/multi-array/Factory/MultiArrayFactory.php";
require_once "jieba-php-master/src/class/Jieba.php";
require_once "jieba-php-master/src/class/Finalseg.php";
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
Jieba::init();
Finalseg::init();
$MAX=0;
$connection=mysqli_connect("localhost","root","!QAZ@WSX","bigfivetest") or die("CONNECTION FAIL");
mysqli_set_charset ($connection,'utf8');
$sql="SELECT uid,post_id,message from post_data_100 where post_check='0';";
$result=$connection->query($sql);
while($row = $result->fetch_object()){
	$post_id=$row->post_id;
	if($row->message!=NULL){
		$uid=$row->uid;
		$word=$row->message;
		$seg_list = Jieba::cut($word);
		$nums=count($seg_list);
		$category_num=array(0,0,0,0,0,0,0,0);
		$category_percent=array(0,0,0,0,0,0,0,0);
		$total_num=0;
		$haveresult=0;

		$connection2=mysqli_connect("localhost","root","!QAZ@WSX","emotion") or die("CONNECTION FAIL");
		mysqli_set_charset ($connection2,'utf8');

		for ($i=0;$i<$nums; $i++)
		{
			$sql2="SELECT * from Emotion where phrase='$seg_list[$i]';";
			$result2=$connection2->query($sql2);

			while($row = $result2->fetch_object()){
				$category_num[$row->category1-1]=$category_num[$row->category1-1]+1;
				$total_num++;		
			}
		}
		mysqli_close($connection2);
		/*
		if($total_num!=0)
		{
			for ($i=0;$i<8; $i++)
			{
				$category_percent[$i]=$category_num[$i]/$total_num*100;
			}
		}
		else
		{
			for ($i=0;$i<8; $i++)
			{	
				$category_percent[$i]=0;
			}
		}*/
		if($total_num>0)
		{
			$haveresult=1;
		}
		
		
		$sql3="INSERT INTO post_emo(uid, post_id, joy, sad, angry, fear, surprise, anticipation, trust, disgust,total,haveresult) VALUES ('$uid','$post_id','$category_num[2]','$category_num[3]',
		'$category_num[6]','$category_num[7]','$category_num[0]','$category_num[1]','$category_num[5]','$category_num[4]','$total_num','$haveresult')";
		$result3=$connection->query($sql3);
		echo $post_id." finish<br>";
		
	}
	else{ echo "no message<br>";}
	$sql4="UPDATE post_data_100 SET post_check='1' WHERE post_id='$post_id'";
	$result4=$connection->query($sql4);	
}
if(mysqli_num_rows($result)==0)
	echo "沒有未分析的資料";
mysqli_close($connection);

$url="http://spark5.widelab.org/~csie062452/web/emo.php";	
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>"; 
?>
