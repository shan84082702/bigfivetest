<?php
	header("Content-Type:text/html; charset=utf-8");
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	$sql="SELECT userID, email, userName FROM result WHERE time>'2016-12-31'";
	$result=$connection->query($sql);
	$num=mysqli_num_rows($result);
	$i=0;
	$userID=array();
	$email=array();
	$userName=array();

	while($row = $result->fetch_object()){
		$userID[$i]=$row->userID;
		$email[$i]=$row->email;
		$userName[$i]=$row->userName;
		$i++;
	}
	
	for($i=0; $i<$num; $i++){
		$sql2="SELECT * FROM user_taskcheck WHERE email='$email[$i]' and userName='$userName[$i]'";
		$result2=$connection->query($sql2);
		if(mysqli_num_rows($result2)>0){
			$sql3="Update user_taskcheck set bigfivetest='1', bigfivetest_userID='$userID' where email='$email[$i]' and userName='$userName[$i]' and bigfivetest='0'";
			$result3=$connection->query($sql3);
		}
		else{
			$sql3="INSERT INTO user_taskcheck(bigfivetest_userID, userName, email, bigfivetest) VALUES ('$userID[$i]', '$userName[$i]', '$email[$i]', '1')";
			$result3=$connection->query($sql3);
		}
	}
	
	
	$sql="SELECT DISTINCT(uid), email, user_Name FROM post_data WHERE 1";
	$result=$connection->query($sql);
	$num=mysqli_num_rows($result);
	$i=0;
	$userID=array();
	$email=array();
	$userName=array();
	
	while($row = $result->fetch_object()){
		$userID[$i]=$row->uid;
		$email[$i]=$row->email;
		$userName[$i]=$row->user_Name;
		$i++;
	}
	
	for($i=0; $i<$num; $i++){
		$sql2="SELECT * FROM user_taskcheck WHERE email='$email[$i]' and userName='$userName[$i]'";
		$result2=$connection->query($sql2);
		if(mysqli_num_rows($result2)>0){
			$sql3="Update user_taskcheck set postupload='1', post_userID='$userID[$i]' where email='$email[$i]' and userName='$userName[$i]' and postupload='0'";
			$result3=$connection->query($sql3);
		}
		else{
			$sql3="INSERT INTO user_taskcheck(post_userID, userName, email, postupload) VALUES ('$userID[$i]', '$userName[$i]', '$email[$i]', '1')";
			$result3=$connection->query($sql3);
		}
	}

?>