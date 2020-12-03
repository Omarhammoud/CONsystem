<?php
if(isset($_GET['MemberID2'])) {
    require "dbh.inc.php";
    $memberID = $_GET['MemberID2'];
    $sql = "DELETE FROM member WHERE MemberID= ? ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../includes/signup.php?error=sqlerror1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $memberID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../includes/signup.php?Deleted_Member");
    }
}