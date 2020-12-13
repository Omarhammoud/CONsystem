<?php
    //Written By: Leslie Poso (40057877)
    session_start();
    $errors = array();
    if($_SESSION['MemberID']){
        if(isset($_POST['SendPrivateEmail'])){
            
            if(empty($_POST['Subject'])){
                $errors['Subject'] = 'Subject is required.';
            }

            if(empty($_POST['Recipient'])){
                $errors['Recipient'] = 'Email is required.';
            }

            if(!strlen(trim($_POST['EmailBody']))){
                $errors['EmailBody'] = 'Email Body is required.';
            }
            
            if(array_filter($errors)){
                header("Location: ./PrivateEmail.php?errors=".urlencode(serialize($errors)));
                exit();
            }else{

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

                $memberID = $_SESSION['MemberID'];
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

                if(mysqli_num_rows($result)>0){
                    $emailInfo = mysqli_fetch_assoc($result);
                    $recipientID = $emailInfo['MemberID'];
                    mysqli_stmt_close($stmt);

                    $stmt = mysqli_stmt_init($conn);
                    $sql = "INSERT INTO `private_email` (`EmailID`, `SenderID`, `RecipientID`, `Subject`, `EmailBody`, `Date`) VALUES (?,?,?,?,?,?)";

                    if (!mysqli_stmt_prepare($stmt,$sql)) {

                        header("Location: ./PrivateEmail.php?error=failedtoaddtoemail");
                        exit();
                    } 
                    mysqli_stmt_bind_param($stmt, "iiisss", $emailID, $memberID, $recipientID, $subject, $emailBody, $currentDate);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    mysqli_close($conn);
                    
                    $success["email"]="Email has been sent successfully";
                    header("Location: ./PrivateEmail.php?success=".urlencode(serialize($success)));
                    exit();

                }else{
                    $errors["email"]="Email does not exist.";
                    header("Location: ./PrivateEmail.php?errors=".urlencode(serialize($errors)));
                    exit();
                } 

            }
               
            
        }else{
            $errors["email"]="Failed to submit the form to send email.";
            header("Location: ./PrivateEmail.php?errors=".urlencode(serialize($errors)));
            exit();
        }

    }else{
        $errors["login"]="Your must be logged in to access this page.";
        header("Location: ./LoginPage.php?errors=".urlencode(serialize($errors)));
        exit();
    }
?>