<?php
session_start();
require "dbh.inc.php";
$memberid = $_SESSION['MemberID'];


    $sql = "SELECT MemberID FROM CondoAdmin WHERE MemberID =? ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./index.php?error=sqlerror1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $memberid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result = mysqli_stmt_num_rows($stmt);

        if ($result == 0) {
            header("Location: ./index.php?error=notAnAdmin");
            echo "<p> Only Admins can add users</p>";
            exit();
        } else if ($result == 1) {
            header("Location: ./signup.php?Success=userisAnAdmin");
            exit();
        }
    }

?>