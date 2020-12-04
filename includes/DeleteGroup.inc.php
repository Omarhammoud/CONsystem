<!--
   Written By: Israt Noor Kazi (40029299)
-->
<?php
    session_start();
    if(isset($_SESSION['MemberID']) && isset($_POST['delete'])){
        
        require "dbh.inc.php";

        $groupID = $_POST['delete_id'];
        $sql = "DELETE FROM `group` WHERE `GroupID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "i",$groupID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

       header('Location: ./GroupPage.php');

    }
?>