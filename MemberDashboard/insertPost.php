<?php
    
    $dbServername = "gzc353.encs.concordia.ca";
$dbUsername = "gzc353_2";
$dbPassword = "B3NGRy"; // default root, nothing for password for xxamp
$dbName = "gzc353_2";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
    $text = $_POST["text"];
    $img = $_POST["img"];
    $pollTitle = $_POST["pollTitle"];
    $pollOpt = $_POST["pollOpt"];
    $numOfPollOpts = count($pollOpt);
    $currDate = date("Y-m-d");

    $sql = "INSERT INTO content 
            VALUES ('1', '$text', '$currDate');";
    mysqli_query($conn, $sql);
    header("Location: ./NewPost.html");


?>