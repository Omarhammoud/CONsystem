<?php include 'header.php'; ?>
<?php include 'functions.inc.php'; ?>
<?php
    // Written By: Leslie Poso (40057877)
    $errors = array();
    if(isset($_SESSION['MemberID'])){
        if(!empty($_GET['EmailID'])){
            require "dbh.inc.php";

            //Fetch Group Information 
            $emaiID = $_GET["EmailID"];
            $sql = "SELECT email.EmailID, email.Date, member.Email, email.Subject, email.EmailBody, `group`.GroupName
            FROM email, send_to, member, `group`
            WHERE send_to.EmailID = email.EmailID
            AND member.MemberID = email.MemberID
            AND send_to.GroupID = `group`.GroupID
            AND email.EmailID=?";
            $stmt =  mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql)){
                $errors["email"]="Cannot fetch the email information due connection problem. (SQL1)";
                header("Location: ./EmailPage.php?errors=".urlencode(serialize($errors)));
                exit();
            }
            
            mysqli_stmt_bind_param($stmt, "i",$emaiID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $emaiInfo = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
        }else{
            $errors["email"]="Email was not found.";
            header("Location: ./EmailPage.php?errors=".urlencode(serialize($errors)));
            exit();
        }
         
    }else{
        $errors["login"]="Your must be logged in to access this page.";
        header("Location: ./LoginPage.php?errors=".urlencode(serialize($errors)));
        exit();
    }
?>

<!-- Html to display the information of the group  -->
<head>
    <!-- example css -->
    <style type="text/css">
        table {
            margin: 8px;
            border: 5px solid #000;
        }
        td {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1em;
            border: 5px solid #000;
        }
        p{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1em;
            border: 5px solid #000;
            text-align: center;
        }
    </style>
</head>

<div class="container">
    <div class="d-flex justify-content-between">
    <table class="table">
        <tr>
            <td><strong>Date:</strong> </td>
            <td><?php echo $emaiInfo['Date'] ;?></td>
            <td><strong>Subject:</strong></td>
            <td><?php echo $emaiInfo['Subject'] ;?></td>
            <td><strong>To Group:</strong></td>
            <td><?php echo $emaiInfo['GroupName'] ;?></td>
            <td><strong>From:</strong></td>
            <td><?php echo $emaiInfo['Email'] ;?></td>	
        </tr>
    </table>
    </div>
    <p><?php echo $emaiInfo['EmailBody'] ;?></p>
</div>

<?php include 'footer.php'; ?>