<?php
   //Written By: Omar Hammoud (40002184)
    
?>
<?php
session_start();
require "dbh.inc.php";
$memberid = $_SESSION['MemberID'];
$privilege = $_SESSION['Privilege'];

//    $sql = "SELECT Privilege FROM member WHERE MemberID =? ";
//    $stmt = mysqli_stmt_init($conn);
//    if (!mysqli_stmt_prepare($stmt, $sql)) {
//        header("Location: ./index.php?error=sqlerror");
//        exit();
//    } else {
//        mysqli_stmt_bind_param($stmt, "i", $memberid);
//        mysqli_stmt_execute($stmt);
//        $result = mysqli_fetch_field($result);

        if ($privilege != "administrator") {
            $_SESSION['isAdmin'] = false;
            header("Location: ./index.php?Success=LoddedinAsMember");
            exit();
        } else if ($privilege == "administrator") {
            $_SESSION['isAdmin'] = true;
            header("Location: ./index.php?Success=LoddedinAsAdmin");
            exit();
        }
//    }

?>