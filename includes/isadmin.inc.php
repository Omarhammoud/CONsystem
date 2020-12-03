<?php
session_start();
require "dbh.inc.php";
$memberid = $_SESSION['memberid'];


    $sql = "SELECT MemberID FROM condoadmin WHERE MemberID =? ";
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
            $_SESSION['isAdmin'] = false;
            header("Location: ./index.php?Success=LoddedinAsMember");
            exit();
        } else if ($result == 1) {
            $_SESSION['isAdmin'] = true;
            header("Location: ./index.php?Success=LoddedinAsAdmin");
            exit();
        }
    }

?>