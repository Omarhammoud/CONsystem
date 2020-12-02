<?php
//Database Handler
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "Consys";

// $servername = "gzc353.encs.concordia.ca";
// $dBUsername = "gzc353_2";
// $dBPassword = "B3NGRy";
// $dBName = "gzc353_2";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword,$dBName );

if(!$conn){

    die("connection failed".mysqli_connect_error());
}