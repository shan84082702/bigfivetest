<?php
    $connection = mysqli_connect("localhost","bigfivetest","bigfivetest","bigfivetest") or die("CONNECTION FAIL");
    $data = $_POST['data'];
    $data = str_replace (chr(13)," ",$data);
    $data = str_replace (chr(10)," ",$data);
    $test = json_decode($data,true);
    if($test==null){
        echo json_encode(array('isSuccess' => false,"msg" => '上傳失敗')); 
    }
    else{
        $uid = $test[id];
        $name = $test[name];
        $email = $test[email];
        $friends = $test[friends][summary][total_count];
        //print_r($test);
        foreach($test[posts][data] as $key=>$value){
            $total_post=$key;
        } 
        //echo $total_post."<br>";
        for($i=0;$i<=$total_post;$i++)
        {
            $post_id = $test[posts][data][$i][id];
            $type = $test[posts][data][$i][type];
            $url = $test[posts][data][$i][full_picture];
            $message = $test[posts][data][$i][message];
            $post_time = $test[posts][data][$i][created_time];
            $post_url = $test[posts][data][$i][permalink_url];
            $is_public = $test[posts][data][$i][privacy][value];
            
            if($is_public=="EVERYONE"){
                $is_public = 1;
            }
            else
                $is_public = 0;
            $sql = "INSERT INTO `post_data` (`uid`,`user_name`, `email`,`post_id`, `type`, `message`, `pic_url`,`post_time`,`post_url`,`is_public`,`friends`) VALUES ('$uid','$name','$email','$post_id', '$type', '$message', '$url','$post_time','$post_url','$is_public','$friends');";
            $result = $connection->query($sql);
            
            //echo "<br>".$post_time;
        }
    }

    
    /*$url="post_emo.php";	
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>"; */
    
   

    
?>