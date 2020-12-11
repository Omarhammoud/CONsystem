<?php
    //Written By: Leslie Poso (40057877)
    session_start();
    $errors = array();
    if($_SESSION['MemberID']){
        if(isset($_POST['SendEmail'])){   
            
            if(empty($_POST['Subject'])){
                $errors['Subject'] = 'Subject is required.';
            }

            if(empty($_POST['Group'])){
                $errors['Group'] = 'Group Name is required.';
            }

            if(!strlen(trim($_POST['EmailBody']))){
                $errors['EmailBody'] = 'Email Body is required.';
            }

            if(array_filter($errors)){
                $errors["email"]="Failed to submit the form to send email.";
                header("Location: ./EmailPage.php?errors=".urlencode(serialize($errors)));
                exit();
            }else{
                require "dbh.inc.php";
                date_default_timezone_set("America/Montreal");
                
                $emailID = 1;
        
                $sql = "SELECT * FROM `email`";
                $stmt = mysqli_stmt_init($conn);
        
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ./EmailPage.php?error=sqlerror1");
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
                $groupName = $_POST['Group'];
                $subject = $_POST['Subject'];
                $emailBody = $_POST['EmailBody'];
                $currentDate = date('Y-m-d');
        
                $sql = "SELECT GroupID FROM `group` WHERE `group`.GroupName = ?";
                $stmt =  mysqli_stmt_init($conn);
        
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ./EmailPage.php?error=sqlerror2");
                    exit();
                }
                
                mysqli_stmt_bind_param($stmt, "s", $groupName);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result)>0){
                    $groupInfo = mysqli_fetch_assoc($result);
                    $groupID = $groupInfo['GroupID'];
                    mysqli_stmt_close($stmt);
            
                    $stmt = mysqli_stmt_init($conn);
                    $sql = "INSERT INTO `email` (`EmailID`, `MemberID`, `Subject`, `EmailBody`, `Date`) VALUES (?,?,?,?,?)";
            
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
            
                        $errors["email"]="Failed to add to email";
                        header("Location: ./EmailPage.php?errors=".urlencode(serialize($errors)));
                        exit();
                    } 
                    mysqli_stmt_bind_param($stmt, "iisss", $emailID, $memberID, $subject, $emailBody, $currentDate);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
            
                    $stmt = mysqli_stmt_init($conn);
                    $sql = "INSERT INTO `send_to` (`EmailID`, `GroupID`) VALUES (?,?)";
            
                    if (!mysqli_stmt_prepare($stmt,$sql)) {
            
                        $errors["email"]="Failed to add to send_to";
                        header("Location: ./EmailPage.php?errors=".urlencode(serialize($errors)));
                        exit();
                    } 
                    mysqli_stmt_bind_param($stmt, "ii", $emailID, $groupID);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
            
                    mysqli_close($conn);
                    
                    $success["email"]="Email has been sent successfully";
                    header("Location: ./EmailPage.php?success=".urlencode(serialize($success)));
                    exit();
                    
                }else{
                    $errors["email"]="Group does not exist.";
                    header("Location: ./EmailPage.php?errors=".urlencode(serialize($errors)));
                    exit();
                }
            }

        }else{
            
            $errors["email"]="Failed to submit the form to send email.";
            header("Location: ./EmailPage.php?errors=".urlencode(serialize($errors)));
            exit();
        }
    }else{
        $errors["login"]="Your must be logged in to access this page.";
        header("Location: ./LoginPage.php?errors=".urlencode(serialize($errors)));
        exit();
    }
    
?>