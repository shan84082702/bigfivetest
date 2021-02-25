<?php
	$restr = "<div class='container mainbg'><form name='send' method = 'post' action='bigfivetest2.php' ><p>『社群網站人格與情緒貼文之調查』</p>";
//	$restr .="<p><br></p>";
	$restr .="<p>請您花費約需 5-10 分鍾完成填寫此份問卷內容，線上送出交還給研究團隊人員。</p>";
	$restr .="<p>問卷中第一部分將請受測者填寫基本資料(年齡、性別、職業與教育程度)。第二部分問卷則請受測者評估自己是否符合問卷題目的描述填寫評分項目。您有絶對的權力決定是否要繼續參與本研究，如果您不願意參加、或希望刪除參與的資料，可在任何時間離開，我們將尊重您的決定。若有任何疑問時請與研究人員聯繫，研究人員將會為您說明並回答相關問題，直到無任何疑問為止。</p>";
	$restr .="<p><br></p>";
	$restr .="<p>研究計畫主持人：蔡采璇 副教授 </p>";
	$restr .="<p>聯絡電話：(03)2118800  轉分機：5423</p>";
	$restr .="<p>日期：2018/05/11</p>";
	$restr .="<p><br></p>";
	$restr .="<p align='center' valign='middle'><input type='submit' value='同意(下一步)'></p></form></div>";
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