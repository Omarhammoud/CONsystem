<html>

	</head>
		<title>Member Dashboard</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	
	<body style="background-color:#DDDFEB">
		
		<div>
	
			<?php
			
				session_start();
				
				
				$servername = "gzc353.encs.concordia.ca";
				$username = "gzc353_2";
				$password = "B3NGRy";
				$num_rows;

				try 
				{
					$conn = new PDO("mysql:host=$servername;dbname=gzc353_2", $username, $password);
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$memberID = $_SESSION['memberID'];

					DISPLAY THE MEMBER POST HERE


	</body>

</html>


