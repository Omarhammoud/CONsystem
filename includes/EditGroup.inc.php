<!--
   Written By: Israt Noor Kazi (40029299)
-->
<?php
    session_start();
    if(isset($_POST['EditGroup']) && isset($_POST['AcceptRequest'])){
        require "dbh.inc.php";

        $groupID = $_POST['edit_id'];
        $groupName = $_POST['GroupName'];

        $sql = "UPDATE `group` SET `GroupName`=? WHERE `GroupID`=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
            }

        mysqli_stmt_bind_param($stmt, "si",$groupName,$groupID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ./EditGroup.php?id=$groupID");

    }else{
        header("Location: ./GroupPage.php?error=sqlerror1");
        exit();
    }
?>