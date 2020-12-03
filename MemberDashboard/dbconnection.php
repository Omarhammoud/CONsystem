<?php

// $dbServername = "gzc353.encs.concordia.ca";
// $dbUsername = "gzc353_2";
// $dbPassword = "B3NGRy";
// $dbName = "gzc353_2";

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = ""; 
$dbName = "gzc353_2";

/*try
{
	session_start();
	$conn = new PDO("mysql:host=$dbServername;dbname=$", $dbUsername, $dbPassword);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
*/
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

?>
