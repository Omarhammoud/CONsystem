<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = ""; 
$dbName = "gzc353_2";


$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


	$postPrivacy = $_POST["postPrivacy"];
    $content = $_POST["content"];
    $img = $_FILES['img']['name'];
	$hasPoll = $_POST["hasPoll"];
	
    $sql = "INSERT INTO content (MemberID, ContentBody, Type, Image)  
			VALUES (3, '$content', '$postPrivacy', '$img')";
			
	if ($conn->query($sql) === TRUE) 
	{
	  $ContentID = $conn->insert_id;
	} 
	else 
	{
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	if($hasPoll == "true")
	{
		$pollTitle = $_POST["pollTitle"];
		$pollOptPlace = $_POST["pollOptPlace"];
		$pollOptDate = $_POST["pollOptDate"];
		$pollOptTime = $_POST["pollOptTime"];  
		
		$sql = "INSERT INTO event_poll (ContentID, title) 
						VALUES ('$ContentID', '$pollTitle');";
		
		foreach ($pollOptPlace as $key => $res)
		{
			$sql .= "INSERT INTO event_option (ContentID, date, time, place)  
				VALUES ('$ContentID' , '$pollOptDate[$key]', '$pollOptTime[$key]', '$pollOptPlace[$key]');";
		}
		
		mysqli_multi_query($conn, $sql);
	}

	
	
	
	mysqli_close($conn);
	
	
    header("Location: ./NewPost.html");


?>