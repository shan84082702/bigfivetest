<?php session_start(); //開啟session的語法 要放在檔案最上方?>
<?php
	header("Content-Type:text/html; charset=utf-8");
	$EX3=0;
	$OP3=0;
	$CO3=0;
	$AG3=0;
	$NE3=0;
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	$sql="SELECT userID, EX_zscore,OP_zscore,CO_zscore,AG_zscore,NE_zscore FROM result WHERE 1 ";
	$result=$connection->query($sql);
	while($row = $result->fetch_object()){
		$EX3=level($row->EX_zscore);
		$OP3=level($row->OP_zscore);
		$CO3=level($row->CO_zscore);
		$AG3=level($row->AG_zscore);
		$NE3=level($row->NE_zscore);
		$userID=$row->userID;
		echo $EX3." ".$OP3." ".$CO3." ".$AG3." ".$NE3." ".$userID."<br>";
		$sql2="UPDATE result set EX_level='$EX3',OP_level='$OP3',CO_level='$CO3',AG_level='$AG3',NE_level='$NE3' WHERE userID='$userID'";
		$result2=$connection->query($sql2);
	}
	
	function level($a)
	{
		$b=0;
		if($a<-0.842){
			$b=1;
		}
		else if($a<-0.253){
			$b=2;
		}
		else if($a<0.253){
			$b=3;
		}
		else if($a<0.842){
			$b=4;
		}
		else{
			$b=5;
		}
		return $b;
	}
?>