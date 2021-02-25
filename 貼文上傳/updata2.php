<?php
    $connection = mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
    $data = $_POST['data'];
    $data = str_replace (chr(13)," ",$data);
    $data = str_replace (chr(10)," ",$data);
    $data = str_replace (chr(92)," ",$data);
    $test = json_decode($data,true);
    $back_sql = "INSERT INTO `backup`(`post`) VALUES ('$data')";
    $back = $connection->query($back_sql);
    if($test==null){
		$datetime = date ("YmdHis"); 
        $filename = "backup_uploadfail/".$datetime.".json";
        $backup = fopen($filename,"a+");
        fwrite($backup,$data);
        fclose($backup);
        echo "檔案已儲存";
    }
    else{
        $uid = $test[id];
        $name = $test[name];
        $email = $test[email];
        $friends = $test[friends][summary][total_count];
        //print_r($test);
        $filename = "backup/".$uid.".json";
        $backup = fopen($filename,"a+");
        fwrite($backup,$data);
        fclose($backup);
        foreach($test[posts][data] as $key=>$value){
            $total_post=$key;
        }
        $total_post+=1;
        $sql = "INSERT INTO `user_postdata`(`uid`, `json_post`,`user_name`, `email`, `friends`) VALUES ('$uid','$total_post','$name','$email','$friends');"; 
        $result = $connection->query($sql);
        //echo $total_post."<br>";
        for($i=0;$i<$total_post;$i++)
        {
            $post_id = $test[posts][data][$i][id];
            $type = $test[posts][data][$i][type];
            $url = $test[posts][data][$i][full_picture];
            $message = $test[posts][data][$i][message];
            $post_time = $test[posts][data][$i][created_time];
            $post_url = $test[posts][data][$i][permalink_url];
            $privacy = $test[posts][data][$i][privacy][value];
            
            if($privacy=="EVERYONE"){
                $is_public = 1;
            }
            else
                $is_public = 0;
            $sql = "INSERT INTO `post_data` (`uid`,`user_name`, `email`,`post_id`, `type`, `message`, `pic_url`,`post_time`,`post_url`,`is_public`,`friends`,`privacy`) VALUES ('$uid','$name','$email','$post_id', '$type', '$message', '$url','$post_time','$post_url','$is_public','$friends','$privacy');";
            $sql_100 = "INSERT INTO `post_data_100` (`uid`,`user_name`, `email`,`post_id`, `type`, `message`, `pic_url`,`post_time`,`post_url`,`is_public`,`friends`,`privacy`) VALUES ('$uid','$name','$email','$post_id', '$type', '$message', '$url','$post_time','$post_url','$is_public','$friends','$privacy');";
            $result = $connection->query($sql);
            $result_100 = $connection->query($sql_100);
            /*$url = "success.php";
            echo "<script type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";*/
        }
        $count = "SELECT COUNT(*) AS totalpost FROM `post_data` WHERE `uid` = '$uid';";
        $count_result = $connection->query($count);
        while($row = $count_result->fetch_object()){
            $true_post = $row->totalpost;
        }
        $insert = "UPDATE `user_postdata` SET `total_post`='$true_post' WHERE `uid`='$uid';";
        $result = $connection->query($insert);
        echo "上傳成功";
		

		$sql2="SELECT * FROM user_taskcheck where email='$email'";
		$result2=$connection->query($sql2);
		if(mysqli_num_rows($result2)>0){
			$sql3="Update user_taskcheck set post_userID='$uid', postupload='1' where email='$email' and postupload='0'";
			$result3=$connection->query($sql3);
		}
		else{
			$sql3="INSERT INTO user_taskcheck (post_userID, userName, email, postupload) VALUES ('$uid', '$name', '$email', '1')";
			$result3=$connection->query($sql3);
		}
    }

    
    /*$url="post_emo.php";	
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>"; */
    
   

    
?>