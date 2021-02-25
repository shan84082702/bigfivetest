<?php session_start(); //開啟session的語法 要放在檔案最上方?>
<?php
	$_SESSION["userAge"]=$userAge=$_POST["age"];
	$_SESSION["userGender"]=$userGender=$_POST["gender"];
	$_SESSION["userJob"]=$userJob=$_POST["job"];
	$_SESSION["userEducation"]=$userEducation=$_POST["education"];
	
	header("Content-Type:text/html; charset=utf-8");
	$connection=mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
	/*if($connection)
		echo "connect success";*/
	//mysql_select_db("bigfivetest");
	$sql="SELECT questionID,question FROM question WHERE 1 ";
	$result=$connection->query($sql);
	$restr= "<div class='container mainbg'><p align='center' valign='middle'>BIG FIVE INVENTORY問卷</p>";
	$restr .= "<form name='send' method = 'post' action='bigfivetest4.php' ><div style='border-radius:5px; box-shadow:1px 1px 1px 1px;'><p align='center' valign='middle'>以下有數個形容詞，請依照您同意或不同意此說法的程度在以下各題中選擇數字</p></div>
	<table border=0 width=100% style='table-layout:fixed'><tr> <td align='center' valign='middle'>1</td> <td align='center' valign='middle'>2</td> <td align='center' valign='middle'>3</td> <td align='center' valign='middle'>4</td> <td align='center' valign='middle'>5</td></tr>
	<tr><td align='center' valign='middle'>非常<br>不同意</td> <td align='center' valign='middle'>不同意</td> <td align='center' valign='middle'>普通</td> <td align='center' valign='middle'>同意</td> <td align='center' valign='middle'>非常同意</td></tr></table>";	
	$restr .="<div style='background-color:#DDDDDD; height:5px;'></div>";
	while($row = $result->fetch_object()){
		$restr .="<table border=0 width=100% style='table-layout:fixed'><tr><td align='center' valign='middle'><br>".$row->question."</td></tr><br></table>
		<div style='height:10px;'></div>
		<table border=0 width=100% style='table-layout:fixed'>
		<td align='center' valign='middle'><input type='radio' name=$row->questionID required='required' value='1' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name=$row->questionID value='2' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name=$row->questionID value='3' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name=$row->questionID value='4' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name=$row->questionID value='5' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr><td align='center' valign='middle'>1</td><td align='center' valign='middle'>2</td><td align='center' valign='middle'>3</td><td align='center' valign='middle'>4</td><td align='center' valign='middle'>5</td></tr></table>";
	}
	//$restr .="</table>";
	$restr .="<table border=0 width=100% style='table-layout:fixed'><tr><td align='center' valign='middle'><br>測驗結束<br>感謝您的回答<br></td></tr><tr><td align='center' valign='middle'><br><input type='submit' value='測驗結果'></form></tr></table></div>";
	echo $restr;
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" >
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <style>
            .mainbg{
                border-style:solid; 
                border-color: darkgray;
                border-radius: 10px;
            }
            .mainbg{
                width:800px;
            }
            @media (max-width: 975px) {
                .mainbg{
                    width:auto;
                }
            }
            .img {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 60%;
            }
            .btn {
                display: block;
                margin-left: auto;
                margin-right: auto;
                border-style:solid; 
                border-color: darkgray;
                border-radius: 10px;
            }
		</style>
	</head> 
</html>