<?php

$num_rows;
$pwdCheck;
if(isset($_POST['login-submit'])){
		//$servername = "gzc353.encs.concordia.ca"; 
		//$username = "gzc353_2";
		//$password = "B3NGRy";
		require 'MemberDashboard/Signup/dbh.php';
		$password = $_POST['password'];
		$username = $_POST['username'];

		$sql = "SELECT * FROM Member WHERE MemberID=?;";
		$stmt = mysqli_stmt_init($conn);
		$accessGranted = false; // Set to true when a username and password matches

		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: LoginPage.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"i",$username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				if($row["password"] == $password)
				{
					$pwdCheck=true;
				}
				else{
					$pwdCheck=false;
				}
				if($pwdCheck == false){
					header("Location: LoginPage.php?error=wrongpwd");
					exit();
				}
				else if($pwdCheck==true){
						session_start();
						$_SESSION['memberID'] = $row["memberID"];
						$_SESSION['name'] = $row["name"];
						$_SESSION['privilege'] = $row["privilege"];
						$_SESSION['address'] = $row["address"];
						$accessGranted = true;
						if ($accessGranted)
						{
							header("Location: MemberDashboard/MemberDashboard.php?login=success");
							exit();
						}
						else
						{
							header("Location: LoginPage.php?login=failed");
							exit();
						}
						

				}	
			}
			else{
				header("Location: LoginPage.php?nouser");
			}
		}			
}
?>

