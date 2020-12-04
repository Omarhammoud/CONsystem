<!--
   Written By: Israt Noor Kazi (40029299)
-->
<?php
    session_start();

    if(isset($_SESSION['MemberID']) && isset($_POST['AcceptRequest'])){
        require "dbh.inc.php";

        $groupID = $_POST['group_id'];
        $memberID = $_POST['member_id'];
        $status = "Accepted";

        $sql = "UPDATE `part_of` SET `Status`=? WHERE `GroupID`=? AND `MemberID`=?" ;
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
            }

        mysqli_stmt_bind_param($stmt, "sii",$status,$groupID,$memberID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ./showGroup.php?id=$groupID");

        
    }else{
        header("Location: ./GroupPage.php?error=FailedToExecuteRequest");
    }
?>