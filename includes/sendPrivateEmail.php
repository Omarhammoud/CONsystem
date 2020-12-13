<?php
    //Written By: Leslie Poso (40057877)
    if(isset($_POST['SendPrivateEmail']) && !empty($_POST['MemberID']) && !empty($_POST['Subject']) && !empty($_POST['Recipient']) && !empty($_POST['EmailBody'])){   
        
        require "dbh.inc.php";
        date_default_timezone_set("America/Montreal");
        
        $emailID = 1;

        $sql = "SELECT * FROM `private_email`";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./PrivateEmail.php?error=sqlerror1");
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

        $memberID = $_POST['MemberID'];
        $recipient = $_POST['Recipient'];
        $subject = $_POST['Subject'];
        $emailBody = $_POST['EmailBody'];
        $currentDate = date('Y-m-d');

        $sql = "SELECT MemberID FROM member WHERE member.Email= ?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./PrivateEmail.php?error=sqlerror2");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $recipient);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $emailInfo = mysqli_fetch_assoc($result);
        $recipientID = $emailInfo['MemberID'];
        mysqli_stmt_close($stmt);

        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `email` (`EmailID`, `MemberID`, `Subject`, `EmailBody`, `Date`) VALUES (?,?,?,?,?)";

        if (!mysqli_stmt_prepare($stmt,$sql)) {

            header("Location: ./PrivateEmail.php?error=failedtoaddtoemail");
            exit();
        } 
        mysqli_stmt_bind_param($stmt, "iisss", $emailID, $memberID, $subject, $emailBody, $currentDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `private_email` (`EmailID`, `RecipientID`) VALUES (?,?)";

        if (!mysqli_stmt_prepare($stmt,$sql)) {

            header("Location: ./EmailPage.php?error=failedtoaddtosendto");
            exit();
        } 
        mysqli_stmt_bind_param($stmt, "ii", $emailID, $recipientID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        mysqli_close($conn);
        
        header("Location: ./PrivateEmail.php?success=EmailSent");    
        
    }else{
        header("Location: ./PrivateEmail.php?error=MissingParameters"); 
    }
?>