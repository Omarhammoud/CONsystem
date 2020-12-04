<?php
   //Written By: Israt Noor Kazi (40029299)
    
?>
<?php
    session_start();
    if(isset($_SESSION['MemberID']) && (isset($_POST['LeaveGroup'])||isset($_POST['DeleteMember']))){
        
        require "dbh.inc.php";

        $groupID = $_POST['group_id'];
        $memberID = $_POST['member_id'];
        $sql = "DELETE FROM `part_of` WHERE `GroupID`=? AND `MemberID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "ii",$groupID,$memberID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if(isset($_POST['DeleteMember'])){
            header("Location: ./EditGroup.php?id=$groupID");
            exit(); 
        }
        
       header("Location: ./showGroup.php?id=$groupID");

    }else{
        header('Location: ./index.php');
    }
?>