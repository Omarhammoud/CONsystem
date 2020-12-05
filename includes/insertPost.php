<?php

 // Written By: Miled Chalal-Henri (26685900)

 require "dbh.inc.php";
if(isset($_SESSION['MemberID'])){
//  $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

	$memberID = $_SESSION['MemberID'];
	$postPrivacy = $_POST["postPrivacy"];
    $content = $_POST["content"];
    $img = $_FILES['img']['name'];
	$hasPoll = $_POST["hasPoll"];
	$privateMember = $_POST["privateMember"];
	//var_dump($privateMember); exit;
    $sql = "INSERT INTO content (MemberID, ContentBody, Type, Image)  
			VALUES ('$memberID', '$content', '$postPrivacy', '$img')";
			
	if ($conn->query($sql) === TRUE) 
	{
	  $ContentID = $conn->insert_id;
	} 
	else 
	{
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	foreach ($privateMember as $key => $res)
	{
		$sql = "INSERT INTO private_content (ContentID, MemberID) VALUES ('$ContentID', '$privateMember[$key]')";
		mysqli_query($conn, $sql);
	}
	
	
	//mysqli_query($conn, $sql);
	if($hasPoll == "true")
	{
		$pollTitle = $_POST["pollTitle"];
		$pollOptPlace = $_POST["pollOptPlace"];
		$pollOptDate = $_POST["pollOptDate"];
		$pollOptTime = $_POST["pollOptTime"];  
		
		$sql = "INSERT INTO event_poll (ContentID, Title) VALUES ('$ContentID', '$pollTitle');";
		
		foreach ($pollOptPlace as $key => $res)
		{
			$sql .= "INSERT INTO event_poll_option (ContentID, Date, Time, Place)  
				VALUES ('$ContentID' , '$pollOptDate[$key]', '$pollOptTime[$key]', '$pollOptPlace[$key]');";
		}
		mysqli_multi_query($conn, $sql);
	}

	
	
	
//	mysqli_close($conn);
	
	
	header("Location: ./MemberDashboard.php");
}else{
	header("Location: ./LoginPage.php");
}


?>