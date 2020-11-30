<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = ""; // default root, nothing for password for xxamp
$dbName = "gzc353_2";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName) or die("could not connect");
    $text = $_POST["text"];
    $img = $_POST["img"];
    $pollTitle = $_POST["pollTitle"];
    $pollOpt = $_POST["pollOpt"];
    $numOfPollOpts = count($pollOpt);
    $currDate = CURDATE();

    $sql = "INSERT INTO content (MemberID, ContentBody, Type, date)  
            VALUES (1, $text, 'public', $currDate);";
    mysqli_query($conn, $sql);
    header("Location: ./NewPost.html");


?>