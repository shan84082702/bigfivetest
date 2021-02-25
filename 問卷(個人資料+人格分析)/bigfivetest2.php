<?php
	header("Content-Type:text/html; charset=utf-8");
	$restr = "<div class='container mainbg'><form name='send' method = 'post' action='bigfivetest3.php' >";
	$restr .="<p align='center' valign='middle'>基本資料</p>";
	$restr .="<br><div style='background-color:#DDDDDD; border-radius:20px;'><table border=0 width=100% style='table-layout:fixed'><tr><td align='center' valign='middle'>年齡</td></tr></table>
		<table border=0 width=100% style='table-layout:fixed'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='age' required='required' value='13-17' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='age' value='18-24' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='age' value='25-34' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='age' value='35-44' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='age' value='45-54' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>13-17</td>
		<td align='center' valign='middle'>18-24</td>
		<td align='center' valign='middle'>25-34</td>
		<td align='center' valign='middle'>35-44</td>
		<td align='center' valign='middle'>45-54</td></tr>
		</table>
		<table border=0 width=50% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='age' value='55-64' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='age' value='65up' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>55-64</td>
		<td align='center' valign='middle'>65或以上</td></tr>
		</table></div>";
	$restr .="<br><div style='background-color:#DDDDDD; border-radius:20px;'><table border=0 width=100% style='table-layout:fixed'><tr><td align='center' valign='middle'>性別</td></tr></table>
		<table border=0 width=40% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='gender' required='required' value='male' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='gender' value='female' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>男性</td>
		<td align='center' valign='middle'>女性</td></tr>
		</table></div>";
	$restr .="<br><div style='background-color:#DDDDDD; border-radius:20px;'><table border=0 width=100% style='table-layout:fixed'><tr><td align='center' valign='middle'>職業</td></tr></table>
		<table border=0 width=100% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='job' required='required' value='學生' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='軍公教' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='服務業' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='金融業' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>學生</td>
		<td align='center' valign='middle'>軍公教</td>
		<td align='center' valign='middle'>服務業</td>
		<td align='center' valign='middle'>金融業</td></tr>
		</table>
		<table border=0 width=100% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='job' value='資訊/科技' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='傳播/廣告/設計' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='藝文' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>資訊/科技</td>
		<td align='center' valign='middle'>傳播/廣告/設計</td>
		<td align='center' valign='middle'>藝文</td></tr>
		</table>
		<table border=0 width=100% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='job' value='自由業' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='醫療' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='製造業' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>自由業</td>
		<td align='center' valign='middle'>醫療</td>
		<td align='center' valign='middle'>製造業</td></tr>
		</table>
		<table border=0 width=100% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='job' value='農林漁牧' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='家管/退休' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='job' value='其他' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>農林漁牧</td>
		<td align='center' valign='middle'>家管/退休</td>
		<td align='center' valign='middle'>其他</td></tr>
		</table></div>";
	$restr .="<br><div style='background-color:#DDDDDD; border-radius:20px;'><table border=0 width=100% style='table-layout:fixed'><tr><td align='center' valign='middle'>最高教育程度</td></tr></table>
		<table border=0 width=100% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='education' required='required' value='國小' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='education' value='國中' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='education' value='高中/高職' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='education' value='五專' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='education' value='大學' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>國小</td>
		<td align='center' valign='middle'>國中</td>
		<td align='center' valign='middle'>高中/職</td>
		<td align='center' valign='middle'>五專</td>
		<td align='center' valign='middle'>大學</td></tr>
		</table>
		<table border=0 width=100% style='table-layout:fixed' align='center' valign='middle'>
		<tr>
		<td align='center' valign='middle'><input type='radio' name='education' value='研究所' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='education' value='博士' style='WIDTH:20px; HEIGHT:20px'></td>
		<td align='center' valign='middle'><input type='radio' name='education' value='其他' style='WIDTH:20px; HEIGHT:20px'></td></tr>
		<tr>
		<td align='center' valign='middle'>研究所</td>
		<td align='center' valign='middle'>博士</td>
		<td align='center' valign='middle'>其他</td></tr>
		</table></div>";
	$restr .="<br><p align='center' valign='middle'><input type='submit' value='下一步'></p></form></div>";
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


