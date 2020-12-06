<?php include 'header.php'; ?>

<?php
    // Written By: Leslie Poso (40057877)
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";

        $memberID = $_SESSION['MemberID'];
        $sql = "SELECT email.EmailID, email.Date, member.Email, email.Subject, email.EmailBody, `group`.GroupName 
        from email, part_of, send_to, member, `group`
        WHERE part_of.GroupID = send_to.GroupID 
        AND email.EmailID = send_to.EmailID 
        AND send_to.GroupID = `group`.GroupID
        AND member.MemberID = email.MemberID
        AND part_of.MemberID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./EmailPage.php?error=sqlerror1");
            echo $stmt->error;
            exit();
            }
        
        mysqli_stmt_bind_param($stmt, "i",$memberID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        
        $sql = "SELECT email.EmailID, email.Date, email.Subject, `group`.GroupName 
        FROM email, send_to, `group`
        WHERE email.EmailID = send_to.EmailID
        AND send_to.GroupID = `group`.GroupID
        AND MemberID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./EmailPage.php?error=sqlerror2");
            exit();
            }
        
        mysqli_stmt_bind_param($stmt, "i",$memberID);
        mysqli_stmt_execute($stmt);
        $sentResult = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        
        mysqli_close($conn);        
 
    }else{
        header("Location:./index.php");
    }
?>
<head>
    <!-- example css -->
    <style type="text/css">
        table {
            margin: 8px;
            border: 5px solid #000;
        }
        tr {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1em;
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
    <h1>Emails</h1>
    <table class="table">
        <tr>
            <th scope="col">List of Messages</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        <tr>
            <td scope="col"><strong>Date</strong></td>
            <td scope="col"><strong>Sender ID</strong></td>
            <td scope="col"><strong>From Group</strong></td>
            <td scope="col"><strong>Subject</strong></td>
            <td scope="col"><strong>View Button</strong></td>
        </tr>
        <?php while($email = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $email['Date'] ;?></td>
            <td><?php echo $email['Email'] ;?></td>
            <td><?php echo $email['GroupName'] ;?></td>
            <td><?php echo $email['Subject'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showEmail.php?EmailID=<?php echo $email['EmailID']; ?>">View Email</a></td>		
        </tr>
        <?php }?>
    </table>
    <h1>Compose an Email</h1>
    <form class="form-inline" action="./sendEmail.php" method="post">
        <input type="text"  class="form-control" name="Subject" require="required" placeholder="Subject" />
        <input type="text"  class="form-control" name="Group" require="required" placeholder="Group Name" />
        <input type="text"  class="form-control" name="EmailBody" require="required" placeholder="Insert Message" />
        <input type="hidden" name="MemberID" value="<?php echo $_SESSION['MemberID']; ?>">
        <input class="btn btn-outline-primary m-3" type="submit" name="SendEmail" value="Send Email">
    </form>
    <h1>Sent Emails</h1>
    <table class="table">
        <tr>
            <th scope="col">List of Messages</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        <tr>
            <td scope="col"><strong>Date</strong></td>
            <td scope="col"><strong>To Group</strong></td>
            <td scope="col"><strong>Subject</strong></td>
            <td scope="col"><strong>View Button</strong></td>
        </tr>
        <?php while($email = mysqli_fetch_assoc($sentResult)){ ?>
        <tr>
            <td><?php echo $email['Date'] ;?></td>
            <td><?php echo $email['GroupName'] ;?></td>
            <td><?php echo $email['Subject'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showEmail.php?EmailID=<?php echo $email['EmailID']; ?>">View Email</a></td>		
        </tr>
        <?php }?>
    </table>
</div>