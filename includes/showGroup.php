<?php include 'header.php'; ?>
<?php
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";
        
        //Fetch Group Information 
        $groupID = $_GET["id"];
        $sql = "SELECT * FROM `group` WHERE `GroupID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./includes/GroupPage.php?error=sqlerror1");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "i",$groupID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $groupInfo = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        
        //Fetch Owner Information
        $sql = "SELECT `Email`, `Name` FROM `member` WHERE `MemberID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
         }
         
        mysqli_stmt_bind_param($stmt, "i",$groupInfo['Owner']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $ownerInfo = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        mysqli_close($conn);

    }
?>
<div class="container">
    <a  class="btn btn-outline-primary" href="./GroupPage.php" >Back</a>
    <div class="card">
        <h1 class="card-header">
            <?php echo $groupInfo['GroupName']?>
        </h1>
        <div class="card-body">
            <p>Date Created: <?php echo $groupInfo['Date']?></p>
            <p>Owner Name: <?php echo $ownerInfo['Name']?></p>
            <p>Owner Email: <?php echo $ownerInfo['Email']?></p>
            <?php if($groupInfo['Owner']==$_SESSION['MemberID']){ ?>
                <form class="pull-right" method="POST" action="./DeleteGroup.inc.php">
                    <input type="hidden" name="delete_id" value="<?php echo $groupID; ?>">
                    <input type="submit" name="delete" value="Delete" class="btn btn-outline-danger">
                </form>
            <?php }?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>