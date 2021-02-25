<?php session_start(); //開啟session的語法 要放在檔案最上方?>
<?php
	//$userName=$_POST["name"];
	for($i=1;$i<=44;$i++){
		$score[$i] = intval($_POST[$i]);
		//echo $score[$i]."<br>";
	}
	header("Content-Type:text/html; charset=utf-8");
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	$sql="SELECT questionID,category,reverse FROM question WHERE 1 ";
	$result=$connection->query($sql);
	//$restr = "<table border=1><tr> <th>題號</th> <th>分數</th>";

	while($row = $result->fetch_object()){
		if($row->reverse == 1){
			$score[$row->questionID]=6-$score[$row->questionID];
			if($score[$row->questionID]==6)
				$score[$row->questionID]=null;
		}
		if($row->category == 'EX')
			$EX += $score[$row->questionID];
		else if($row->category == 'OP')
			$OP += $score[$row->questionID];
		else if($row->category == 'CO')
			$CO += $score[$row->questionID];
		else if($row->category == 'AG')
			$AG += $score[$row->questionID];
		else if($row->category == 'NE')
			$NE += $score[$row->questionID];
		$total += $score[$row->questionID];
		$restr .= "<tr><td>".$row->questionID."</td><td>".$score[$row->questionID]."</td>";
		if($row->reverse == 1){
			$score[$row->questionID]=6-$score[$row->questionID];
			if($score[$row->questionID]==6)
				$score[$row->questionID]=null;
		}
	}
	$EX=$EX/8;
	$OP=$OP/10;
	$CO=$CO/9;
	$AG=$AG/9;
	$NE=$NE/8;
	$userID=$_SESSION["userID"];
	$userName=$_SESSION["userName"];
	$userEmail=$_SESSION["userEmail"];
	$b=$_SESSION["userAge"];
	$c=$_SESSION["userGender"];
	$d=$_SESSION["userJob"];
	$e=$_SESSION["userEducation"];
	$sql2="INSERT INTO result(userID,userName,email,age,gender,job,education,Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,Q9,Q10,Q11,Q12,Q13,Q14,Q15,Q16,Q17,Q18,Q19,Q20,Q21,Q22,Q23,Q24,Q25,Q26,Q27,Q28,Q29,Q30,
	Q31,Q32,Q33,Q34,Q35,Q36,Q37,Q38,Q39,Q40,Q41,Q42,Q43,Q44,EX_total, OP_total, CO_total, AG_total, NE_total) 
	VALUES ('$userID','$userName','$userEmail','$b','$c','$d','$e','$score[1]', '$score[2]', '$score[3]', '$score[4]', '$score[5]', '$score[6]', '$score[7]', '$score[8]', '$score[9]', '$score[10]', 
	'$score[11]', '$score[12]', '$score[13]', '$score[14]', '$score[15]', '$score[16]', '$score[17]', '$score[18]', '$score[19]', '$score[20]', 
	'$score[21]', '$score[22]', '$score[23]', '$score[24]', '$score[25]', '$score[26]', '$score[27]', '$score[28]', '$score[29]', '$score[30]', 
	'$score[31]', '$score[32]', '$score[33]', '$score[34]', '$score[35]', '$score[36]', '$score[37]', '$score[38]', '$score[39]', '$score[40]', 
	'$score[41]', '$score[42]', '$score[43]', '$score[44]', '$EX', '$OP', '$CO', '$AG', '$NE')";
	$result2=$connection->query($sql2);

	$sql3="SELECT userID, EX_total, OP_total, CO_total, AG_total, NE_total FROM result WHERE 1";
	$result3=$connection->query($sql3);
	$num=mysqli_num_rows($result3);
	$i=0;
	$userID_array=array();
	$EX_array=array();
	$OP_array=array();
	$CO_array=array();
	$AG_array=array();
	$NE_array=array();
	$EX_zscore_array=array();
	$OP_zscore_array=array();
	$CO_zscore_array=array();
	$AG_zscore_array=array();
	$NE_zscore_array=array();
	$EX_level=array();
	$OP_level=array();
	$CO_level=array();
	$AG_level=array();
	$NE_level=array();
	$sort_array_EX=array();
	$sort_array_OP=array();
	$sort_array_CO=array();
	$sort_array_AG=array();
	$sort_array_NE=array();
	$EX_avg=0;
	$OP_avg=0;
	$CO_avg=0;
	$AG_avg=0;
	$NE_avg=0;
	$EX_std=0;
	$OP_std=0;
	$CO_std=0;
	$AG_std=0;
	$NE_std=0;
	while($row = $result3->fetch_object()){
		$userID_array[$i]=$row->userID;
		$EX_array[$i]=$row->EX_total;
		$OP_array[$i]=$row->OP_total;
		$CO_array[$i]=$row->CO_total;
		$AG_array[$i]=$row->AG_total;
		$NE_array[$i]=$row->NE_total;
		$i++;
	}
	for($i=0; $i<$num; $i++){
		$EX_avg+=$EX_array[$i];
		$OP_avg+=$OP_array[$i];
		$CO_avg+=$CO_array[$i];
		$AG_avg+=$AG_array[$i];
		$NE_avg+=$NE_array[$i];
	}
	$EX_avg=round($EX_avg/$num,3);
	$OP_avg=round($OP_avg/$num,3);
	$CO_avg=round($CO_avg/$num,3);
	$AG_avg=round($AG_avg/$num,3);
	$NE_avg=round($NE_avg/$num,3);
	for($i=0; $i<$num; $i++){
		$EX_std+=pow($EX_array[$i]-$EX_avg,2);
		$OP_std+=pow($OP_array[$i]-$OP_avg,2);
		$CO_std+=pow($CO_array[$i]-$CO_avg,2);
		$AG_std+=pow($AG_array[$i]-$AG_avg,2);
		$NE_std+=pow($NE_array[$i]-$NE_avg,2);
	}
	$EX_std=round(sqrt($EX_std/$num),3);
	$OP_std=round(sqrt($OP_std/$num),3);
	$CO_std=round(sqrt($CO_std/$num),3);
	$AG_std=round(sqrt($AG_std/$num),3);
	$NE_std=round(sqrt($NE_std/$num),3);
	
	//算出ZSCORE
	for($i=0; $i<$num; $i++){
		$EX2=$sort_array_EX[$i]=$EX_zscore_array[$i]=($EX_array[$i]-$EX_avg)/$EX_std;
		$OP2=$sort_array_OP[$i]=$OP_zscore_array[$i]=($OP_array[$i]-$OP_avg)/$OP_std;
		$CO2=$sort_array_CO[$i]=$CO_zscore_array[$i]=($CO_array[$i]-$CO_avg)/$CO_std;
		$AG2=$sort_array_AG[$i]=$AG_zscore_array[$i]=($AG_array[$i]-$AG_avg)/$AG_std;
		$NE2=$sort_array_NE[$i]=$NE_zscore_array[$i]=($NE_array[$i]-$NE_avg)/$NE_std;
		$ID=$userID_array[$i];
		$sql4="Update result set EX_zscore='$EX2', OP_zscore='$OP2', CO_zscore='$CO2', AG_zscore='$AG2', NE_zscore='$NE2' where userID='$ID'";
		$result4=$connection->query($sql4);
	}
	
	$percent_num=array(ceil($num*0.2),ceil($num*0.4),ceil($num*0.6),ceil($num*0.8));
	
	
	sort($sort_array_EX);
	sort($sort_array_OP);
	sort($sort_array_CO);
	sort($sort_array_AG);
	sort($sort_array_NE);
	
	for($i=0; $i<4; $i++){
		$EX_level[$i]=$sort_array_EX[$percent_num[$i]];
		$OP_level[$i]=$sort_array_OP[$percent_num[$i]];
		$CO_level[$i]=$sort_array_CO[$percent_num[$i]];
		$AG_level[$i]=$sort_array_AG[$percent_num[$i]];
		$NE_level[$i]=$sort_array_NE[$percent_num[$i]];
		//echo $EX_level[$i]." ".$OP_level[$i]." ".$CO_level[$i]." ".$AG_level[$i]." ".$NE_level[$i]."<br>";
	}
	
	//--------------------------------------------------
	
	$EX2=($EX-$EX_avg)/$EX_std;
	$OP2=($OP-$OP_avg)/$OP_std;
	$CO2=($CO-$CO_avg)/$CO_std;
	$AG2=($AG-$AG_avg)/$AG_std;
	$NE2=($NE-$NE_avg)/$NE_std;
	$EX3=level($EX2,$EX_level);
	$OP3=level($OP2,$OP_level);
	$CO3=level($CO2,$CO_level);
	$AG3=level($AG2,$AG_level);
	$NE3=level($NE2,$NE_level);

	$text="";
	if($EX3>=4)
		$text.="<p align='center' valign='middle'>外向性</p><p align='center' valign='middle'>您是積極、自信的，並善於交際和健談的。你傾向擁有更多的朋友，內心對友誼感到滿意。主動、熱情、活潑且具領導力都是常見於您身上描述特質。您也享受參與熱鬧場合。</p><br>";
	if($NE3>=4)	
		$text.="<p align='center' valign='middle'>神經質</p><p align='center' valign='middle'>您的情緒敏感、易緊張、擔心。追求安全感是對你來說很重要課題。</p><br>";
	if($OP3>=4)
		$text.="<p align='center' valign='middle'>經驗開放性</p><p align='center' valign='middle'>您的興趣廣泛，對於陌生事物具有接納性，願意主動尋求體驗新經驗與探索新技能。您通常具有開闊的心胸、富於想像力、好奇心、創造力、喜歡思考及求新求變的特質。</p><br>";
	if($AG3>=4)
		$text.="<p align='center' valign='middle'>親和性</p><p align='center' valign='middle'>您特別有具有禮貌且受到身邊的家人、朋友信賴。您通常待人友善且容易相處。您特別願意進行利他行為，給予身邊人事物的情感支持，提升他人福祉。</p><br>";
	if($CO3>=4)
		$text.="<p align='center' valign='middle'>盡責性</p><p align='center' valign='middle'>您是一個專心一志、集中精力追求目標的人。您努力工作、期待觸及更高的成就。不屈不撓、有始有終，負責任與遵守紀律、謹慎、責任感高與細心都是常見於您身上描述特質。</p><br>";
	if($EX3<4 && $NE3<4 && $OP3<4 && $AG3<4 && $CO3<4)
		$text.="<p align='center' valign='middle'>沒有明確結果。</p><br>";
	
	$restr = "<form name='send' method = 'post' action='foodrec2.php' >";
	$restr .="<p align='center' valign='middle'><input type='submit' value='開始使用'></p></form>";
	
	for($i=0; $i<$num; $i++){
		$EX3=level($EX_zscore_array[$i],$EX_level);
		$OP3=level($OP_zscore_array[$i],$OP_level);
		$CO3=level($CO_zscore_array[$i],$CO_level);
		$AG3=level($AG_zscore_array[$i],$AG_level);
		$NE3=level($NE_zscore_array[$i],$NE_level);
		$ID=$userID_array[$i];
		$sql4="Update result set EX_level='$EX3', OP_level='$OP3', CO_level='$CO3', AG_level='$AG3', NE_level='$NE3' where userID='$ID'";
		$result4=$connection->query($sql4);
	}
	
	
	$sql5="SELECT * FROM user_taskcheck WHERE email='$userEmail'";
	$result5=$connection->query($sql5);
	if(mysqli_num_rows($result5)>0){
		$sql6="Update user_taskcheck set bigfivetest='1', bigfivetest_userID='$userID' where email='$userEmail' and bigfivetest='0'";
		$result6=$connection->query($sql6);
	}
	else{
		$sql6="INSERT INTO user_taskcheck(bigfivetest_userID, userName, email, bigfivetest) VALUES ('$userID', '$userName', '$userEmail', '1')";
		$result6=$connection->query($sql6);
	}
	
	function level($a,$array)
	{
		$b=0;
		if($a<$array[0]){
			$b=1;
		}
		else if($a<$array[1]){
			$b=2;
		}
		else if($a<$array[2]){
			$b=3;
		}
		else if($a<$array[3]){
			$b=4;
		}
		else{
			$b=5;
		}
		return $b;
	}

?>
<!DOCTYPE html> 
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" >
		<title>bigfivetest</title>
	</head> 
	<body> 
	<p align='center' valign='middle'>測試結果</p><br>
	<div style="position:absolute; text-align:center; width:96%; top:25%">
	
	<div id="fb-root" style="text-align:center;"></div>
	<div id="user-info" style="text-align:center;"></div>
	<div id="white" style="text-align:center;"></div>
	<div id="info" style="text-align:center;"></div>

		<script>
		var userID="";
		window.fbAsyncInit = function() {
		  FB.init({ appId: '271324326733538', 
				status: true, 
				cookie: true,
				xfbml: true,
				oauth: true});

		  function updateButton(response) {
			//var button = document.getElementById('fb-auth');
				
			if (response.authResponse) {
			  //user is already logged in and connected
			  var userInfo = document.getElementById('user-info');
			  FB.api('/me', function(response) {
				userInfo.innerHTML = '<img src="https://graph.facebook.com/' 
			  + response.id + '/picture">' + '<br>' + response.name;
				//button.innerHTML = 'Logout';
				document.getElementById("myButton").disabled = false;
				userID=response.id;
			  });
			
			}
		  }
		  // run once with current status and whenever the status changes
		  FB.getLoginStatus(updateButton);
		  FB.Event.subscribe('auth.statusChange', updateButton);    
		};
			
		(function() {
		  var e = document.createElement('script'); e.async = true;
		  e.src = document.location.protocol 
			+ '//connect.facebook.net/en_US/all.js';
		  document.getElementById('fb-root').appendChild(e);
		}());
		
		document.getElementById("white").innerHTML="</br>";
		document.getElementById("info").innerHTML="<?php echo $text;?><?php echo $restr;?>";

		</script>
	</body> 
</html>