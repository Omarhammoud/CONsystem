<?php
   //Written By: Israt Noor Kazi (40029299)
    
?>
<?php
    if(isset($_POST['JoinGroup'])){
       
        require "dbh.inc.php";
        date_default_timezone_set("America/Montreal");
        $groupID = $_POST["group_id"];
        $memberID = $_POST["member_id"];
        $currentDate = date('Y-m-d');
        $status = "In Progress";
    
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `part_of`(`MemberID`,`GroupID`,`Status`,`RequestDate`) VALUES (?,?,?,?)";
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {

            header("Location: ./GroupPage.php?error=sql");
            exit()
            ;
        } 
        
        mysqli_stmt_bind_param($stmt, "iiss",$memberID,$groupID,$status ,$currentDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: ./showGroup.php?id=$groupID");

    }else{
        header("Location: ./GroupPage.php?error=FaildToJoinGroup");
    }
?>