<?php
    session_start();
    if(isset($_POST['CreateGroup']) && !empty($_POST['GroupName'])){   
        
        require "dbh.inc.php";
        date_default_timezone_set("America/Montreal");

        $groupID = 6;
        $groupName = $_POST['GroupName'];
        $owner = $_SESSION["MemberID"];
        $currentDate = date('Y-m-d');

        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `group`(`GroupID`, `GroupName`, `Date`, `Owner`) VALUES (?,?,?,?)";
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {

            header("Location: ./GroupPage.php?error=GroupNotCreated");
            exit()
            ;
        } 
                
        mysqli_stmt_bind_param($stmt, "issi",$groupID,$groupName, $currentDate, $owner);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ./GroupPage.php?success=GroupCreated");    
        
    }
?>