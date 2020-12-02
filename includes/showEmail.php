<?php include 'header.php'; ?>
<?php include 'functions.inc.php'; ?>
<?php
    // Written By: Leslie Poso (40057877)
    if(isset($_SESSION['MemberID']) && !empty($_GET['EmailID'])){
        require "dbh.inc.php";

        //Fetch Group Information 
        $emaiID = $_GET["EmailID"];
        $sql = "SELECT * FROM `email` WHERE `EmailID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./EmailPage.php?error=sqlerror1");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "i",$emaiID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $emaiInfo = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);  
    }else{
        header("Location: ./index.php");
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
            <td>Date: </td>
            <td><?php echo $emaiInfo['Date'] ;?></td>
            <td>Subject: </td>
            <td><?php echo $emaiInfo['Subject'] ;?></td>
            <td>Sender ID: </td>
            <td><?php echo $emaiInfo['MemberID'] ;?></td>	
        </tr>
    </table>
    </div>
    <p><?php echo $emaiInfo['EmailBody'] ;?></p>
</div>

<?php include 'footer.php'; ?>