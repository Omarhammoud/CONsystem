<?php include 'header.php'; ?>

<?php
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";
        $memberID = $_SESSION['MemberID'];
        $sql = "SELECT * FROM `email` WHERE `MemberID`= ?";
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

<div class="container">
    <h1>Emails</h1>
    <table class="table">
        <tr>
            <th scope="col">List of Messages</th>
            <th scope="col"></th>
        </tr>
        <?php while($email = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $email['Subject'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showEmail.php?EmailID=<?php echo $email['EmailID']; ?>">View Email</a></td>		
        </tr>
        <?php }?>
    </table>
    <h1>Compose an Email</h1>
    <form class="form-inline" action="./sendEmail.inc.php" method="post">
        <input type="text"  class="form-control" name="Subject" require="required" placeholder="Subject" />
        <input type="text"  class="form-control" name="Recipient" require="required" placeholder="Recipient" />
        <input type="text"  class="form-control" name="EmailBody" require="required" placeholder="Insert Message" />
        <input class="btn btn-outline-primary m-3" type="submit" name="SendEmail" value="Send Email">
    </form>

</div>