<?php session_start(); //開啟session的語法 要放在檔案最上方?>
<?php
	$_SESSION["userID"]=$userID=$_GET["userID"];
	$_SESSION["userName"]=$_GET["userName"];
	$_SESSION["userEmail"]=$_GET["userEmail"];
//	echo $_SESSION["userID"];
	header("Content-Type:text/html; charset=utf-8");
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	$sql="SELECT userID FROM result WHERE userID='$userID' ";
	$result=$connection->query($sql);
	if ($result->num_rows>0){
		$url="http://spark5.widelab.org/~csie062452/bigfivetest_mobile/foodrec2.php";	
		echo "<script type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>"; 
	}	
	else
	{
		$url="http://spark5.widelab.org/~csie062452/bigfivetest_mobile/bigfivetest1.php";	
		echo "<script type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>"; 

	}
?>	