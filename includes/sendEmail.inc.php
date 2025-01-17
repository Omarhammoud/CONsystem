<?php
    //Written By: Leslie Poso (40057877)
    if(isset($_POST['SendEmail']) && !empty($_POST['Subject']) && !empty($_POST['Recipient']) && !empty($_POST['EmailBody'])){   
        
        require "dbh.inc.php";
        date_default_timezone_set("America/Montreal");
        
        $emailID = 1;

        $sql = "SELECT * FROM `email`";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
            }

        mysqli_stmt_execute($stmt);
        $emails = mysqli_stmt_get_result($stmt);

        while ($count = mysqli_fetch_assoc($emails)){
            if ($emailID <= $count['EmailID']){
                $emailID++;
            }
        }
        mysqli_stmt_close($stmt);

        $memberID = $_POST['Recipient'];
        $subject = $_POST['Subject'];
        $emailBody = $_POST['EmailBody'];
        $currentDate = date('Y-m-d');
        
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `email` (`EmailID`, `MemberID`, `Subject`, `EmailBody`, `Date`) VALUES (?,?,?,?,?)";

        if (!mysqli_stmt_prepare($stmt,$sql)) {

            header("Location: ./EmailPage.php?error=sql2");
            exit()
            ;
        } 
        mysqli_stmt_bind_param($stmt, "iisss", $emailID, $memberID, $subject, $emailBody, $currentDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        
        header("Location: ./EmailPage.php?success=EmailSent");    
        
    }else{
        header("Location: ./EmailPage.php?error=MissingParameters"); 
    }
?>