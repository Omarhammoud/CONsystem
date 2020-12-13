<?php
  /*Written By: Omar Hammoud (40002184)
    */
?>
<?php

//Database Handler

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "gzc353_2";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword,$dBName );

if(!$conn){

    die("connection failed".mysqli_connect_error());
}
