<?php include 'header.php'; ?>
<?php include 'functions.inc.php'; ?>
<?php
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";

        //Fetch Group Information 
        $groupID = $_GET["id"];
        $sql = "SELECT * FROM `group` WHERE `GroupID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
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
            header("Location: ./GroupPage.php?error=sqlerror2");
            exit();
         }
         
        mysqli_stmt_bind_param($stmt, "i",$groupInfo['Owner']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $ownerInfo = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);


        //Fetch Members Information 
        $sql = "SELECT `MemberID` FROM `part_of` WHERE `GroupID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror3");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i",$groupID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $member_ids = array();
        while($id = mysqli_fetch_assoc($result)){
            array_push($member_ids, $id);
        }
        mysqli_stmt_close($stmt);

        $memberInfo = array();
        $sql = "SELECT `MemberID`,  `Email`, `Name` FROM `member` WHERE `MemberID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror4");
            exit();
        }

        foreach($member_ids as $id){           
            mysqli_stmt_bind_param($stmt, "i", $id['MemberID']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            array_push($memberInfo, mysqli_fetch_assoc($result));
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }else{
        header("Location: ./index.php");
    }
?>

<!-- Html to display the information of the group  -->
<div class="container">
    
    <div class="d-flex justify-content-between">
        <a  class="btn btn-outline-primary m-2" href="./GroupPage.php" >Back</a>
        <?php if(!isPartOfGroup($member_ids,$_SESSION['MemberID'])) {?>
            <form method="POST" action="./JoinGroup.inc.php">
                <input type="hidden" name="group_id" value="<?php echo $groupID; ?>">
                <input type="hidden" name="member_id" value="<?php echo $_SESSION['MemberID']; ?>">
                <input type="submit" name="JoinGroup" value="Join Group" class="btn btn-outline-success m-2">
            </form>
        <?php }?>
    </div>

    <div class="card">
        <h1 class="card-header">
            <?php echo $groupInfo['GroupName']?>
        </h1>
        <div class="card-body">
            <p>Created By: <?php echo $ownerInfo['Name']?></p>
            <p>Email: <?php echo $ownerInfo['Email']?></p>
            <?php if($groupInfo['Owner']==$_SESSION['MemberID']){ ?>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-warning" href="./EditGroup.php?id=<?php echo $groupID; ?>">Edit</a>
                    <form method="POST" action="./DeleteGroup.inc.php">
                        <input type="hidden" name="delete_id" value="<?php echo $groupID; ?>">
                        <input type="submit" name="delete" value="Delete" class="btn btn-outline-danger">
                    </form>
                </div>
            <?php }?>
        </div>
    </div>

    <div class="card mt-5">
        <h1 class="card-header">
            List of Members
        </h1>
        <ul class="list-group list-group-flush">
            <?php foreach($memberInfo as $member){
                if($groupInfo['Owner'] !=$member['MemberID']){
                ?>
                <p>Name: <?php echo $member['Name']?></p>
                <p>Email: <?php echo $member['Email']?></p>
            <?php }
                }?>
        </ul>
    </div>

</div>

<?php include 'footer.php'; ?>