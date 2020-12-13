

<?php
    // Written By: Leslie Poso (40057877)
    session_start();

    if (isset($_GET['errors'])) {
        $str_arr = unserialize(urldecode($_GET['errors']));
    }

    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";

        $memberID = $_SESSION['MemberID'];
        $sql = "SELECT DISTINCT email.EmailID, email.Date, s.Email, email.Subject, email.EmailBody
        from email, private_email, member s, member r
        WHERE email.EmailID = private_email.EmailID 
        AND s.MemberID = email.MemberID
        AND private_email.RecipientID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./PrivateEmail.php?error=sqlerror1");
            echo $stmt->error;
            exit();
            }
        
        mysqli_stmt_bind_param($stmt, "i",$memberID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        
        $sql = "SELECT DISTINCT email.EmailID, email.Date, r.Email, email.Subject, email.EmailBody
        from email, private_email, member s, member r
        WHERE email.EmailID = private_email.EmailID 
        AND r.MemberID = private_email.RecipientID
        AND email.MemberID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        $sql = "SELECT email.EmailID, email.Date, r.Email, email.Subject, email.EmailBody
        from email, private_email, member s, member r
        WHERE email.EmailID = private_email.EmailID 
        AND r.MemberID = private_email.RecipientID
        AND email.MemberID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./PrivateEmail.php?error=sqlerror2");
            exit();
            }
        
        mysqli_stmt_bind_param($stmt, "i",$memberID);
        mysqli_stmt_execute($stmt);
        $sentResult = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        
        mysqli_close($conn); 
    }else{

        $errors["login"]="Your must be logged in to access this page.";
        header("Location: ./LoginPage.php?errors=".urlencode(serialize($errors)));
        exit();
    }
?>
<?php include 'header.php'; ?>
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

    <?php if (isset($str_arr) && !empty($str_arr['email'])) { ?>
        <div class="alert alert-danger">
            <strong>Error!</strong> <?php echo $str_arr['email'] ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { 
        $success = unserialize(urldecode($_GET['success']));
        ?>
        <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $success['email'] ;?>
        </div>
    <?php } ?>
    <a href="./EmailPage.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Go to Group Email</a>
    <h1>Private Emails</h1>
    <table class="table">
        <tr>
            <th scope="col">List of Received Private Emails </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        <tr>
            <td scope="col"><strong>Date</strong></td>
            <td scope="col"><strong>From</strong></td>
            <td scope="col"><strong>Subject</strong></td>
            <td scope="col"><strong>View Button</strong></td>
        </tr>
        <?php while($email = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $email['Date'] ;?></td>
            <td><?php echo $email['Email'] ;?></td>
            <td><?php echo $email['Subject'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showPrivateEmail.php?EmailID=<?php echo $email['EmailID']; ?>">View Email</a></td>		
        </tr>
        <?php }?>
    </table>
    <h1>Compose an Email</h1>
    <form class="form-inline" action="./sendPrivateEmail.php" method="post">
        <div class="form-group col-3">
            <input type="text"  class="form-control" name="Subject" require="required" placeholder="Subject" />
            <?php if (isset($str_arr) && !empty($str_arr['Subject'])) { ?>
                <span class="form-text text-danger"><?php echo $str_arr['Subject'] ?></span>
            <?php } ?>
        </div>

        <div class="form-group col-3">
            <input type="text"  class="form-control" name="Recipient" require="required" placeholder="Recipient Email" />
            <?php if (isset($str_arr) && !empty($str_arr['Recipient'])) { ?>
                <span class="form-text text-danger"><?php echo $str_arr['Recipient'] ?></span>
            <?php } ?>
        </div>
        
        <div class="form-group col-3">
            <textarea type="text"  class="form-control" name="EmailBody" require="required" placeholder="Insert Message"> </textarea>
            <?php if (isset($str_arr) && !empty($str_arr['EmailBody'])) { ?>
                <span class="form-text text-danger"><?php echo $str_arr['EmailBody'] ?></span>
            <?php } ?> 
        </div>
        <input class="btn btn-outline-primary m-3" type="submit" name="SendPrivateEmail" value="Send Email">
    </form>

    <h1>Sent Emails</h1>
    <table class="table">
        <tr>
            <th scope="col">List of Sent Private Emails</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        <tr>
            <td scope="col"><strong>Date</strong></td>
            <td scope="col"><strong>To</strong></td>
            <td scope="col"><strong>Subject</strong></td>
            <td scope="col"><strong>View Button</strong></td>
        </tr>
        <?php while($email = mysqli_fetch_assoc($sentResult)){ ?>
        <tr>
            <td><?php echo $email['Date'] ;?></td>
            <td><?php echo $email['Email'] ;?></td>
            <td><?php echo $email['Subject'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showPrivateEmail.php?EmailID=<?php echo $email['EmailID']; ?>">View Email</a></td>		
        </tr>
        <?php }?>
    </table>
</div>