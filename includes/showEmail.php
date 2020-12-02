<?php include 'header.php'; ?>
<?php include 'functions.inc.php'; ?>
<?php
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
<div class="container">
    <div class="d-flex justify-content-between">
    <table class="table">
        <tr>
            <td><?php echo $emaiInfo['Date'] ;?></td>
            <td><?php echo $emaiInfo['Subject'] ;?></td>		
            <td><?php echo $emaiInfo['EmailBody'] ;?></td>	
        </tr>
    </table>
    </div>
</div>

<?php include 'footer.php'; ?>