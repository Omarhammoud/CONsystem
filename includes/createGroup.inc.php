<?php
   /*Written By: Israt Noor Kazi (40029299)
   */
?>
<?php
    session_start();
    if(isset($_POST['CreateGroup']) && !empty($_POST['GroupName'])){   
        
        require "dbh.inc.php";
        date_default_timezone_set("America/Montreal");

        $groupID = 1;
        $groupName = $_POST['GroupName'];
        $owner = $_SESSION["MemberID"];
        $currentDate = date('Y-m-d');
        $status = "Accepted";

        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `group`(`GroupID`, `GroupName`, `Date`, `Owner`) VALUES (?,?,?,?)";
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {

            header("Location: ./GroupPage.php?error=sql1");
            exit()
            ;
        } 
                
        mysqli_stmt_bind_param($stmt, "issi",$groupID,$groupName, $currentDate, $owner);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `part_of`(`MemberID`,`GroupID`,`Status`,`RequestDate`) VALUES (?,?,?,?)";
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {

            header("Location: ./GroupPage.php?error=sql2");
            exit()
            ;
        } 
        
        mysqli_stmt_bind_param($stmt, "iiss",$_SESSION['MemberID'],$groupID,$status ,$currentDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


        mysqli_close($conn);
        header("Location: ./GroupPage.php?success=GroupCreated");    
        
    }else{
        header("Location: ./GroupPage.php?error="); 
    }
?>