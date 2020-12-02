<?php include 'header.php'; ?>

<?php
    // Written By: Leslie Poso (40057877)
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";

        $memberID = $_SESSION['MemberID'];
        $sql = $sql = "SELECT email.EmailID, email.Date, email.MemberID, email.Subject, email.EmailBody 
        from email, part_of, send_to 
        WHERE part_of.GroupID = send_to.GroupID 
        AND email.EmailID = send_to.EmailID 
        AND part_of.MemberID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./EmailPage.php?error=sqlerror1");
            exit();
            }
        
        mysqli_stmt_bind_param($stmt, "i",$memberID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
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
        </tr>
        <tr>
            <td scope="col">Date</td>
            <td scope="col">Sender ID</td>
            <td scope="col">Subject</td>
            <td scope="col">View Button</td>
        </tr>
        <tr>
            <td scope="col">Date</td>
            <td scope="col">Sender ID</td>
            <td scope="col">Subject</td>
            <td scope="col"></td>
        </tr>
        <?php while($email = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $email['Date'] ;?></td>
            <td><?php echo $email['MemberID'] ;?></td>
            <td><?php echo $email['Subject'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showEmail.php?EmailID=<?php echo $email['EmailID']; ?>">View Email</a></td>		
        </tr>
        <?php }?>
    </table>
    <h1>Compose an Email</h1>
    <form class="form-inline" action="./sendEmail.php" method="post">
        <input type="text"  class="form-control" name="Subject" require="required" placeholder="Subject" />
        <input type="text"  class="form-control" name="Group" require="required" placeholder="Group ID" />
        <input type="text"  class="form-control" name="EmailBody" require="required" placeholder="Insert Message" />
        <input type="hidden" name="MemberID" value="<?php echo $_SESSION['MemberID']; ?>">
        <input class="btn btn-outline-primary m-3" type="submit" name="SendEmail" value="Send Email">
    </form>

</div>