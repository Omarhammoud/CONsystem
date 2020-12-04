<?php
   //Written By: Israt Noor Kazi (40029299)
    
?>
<?php include 'header.php'; ?>
<?php include 'functions.inc.php'; ?>
<?php
    if(isset($_SESSION['MemberID']) && !empty($_GET['id'])){
        require "dbh.inc.php";

        //Fetch Group Information 
        $groupID = $_GET["id"];

        $sql = "SELECT `group`.`GroupName`,`group`.`Date`, `group`.`Owner`,`member`.`Name`,`member`.`Email` 
                FROM `group` LEFT JOIN `member` ON `member`.`MemberID`=`group`.`Owner` 
                WHERE `GroupID`=?";

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
        

        //Fetch Members Information 
        $sql = "SELECT `member`.`MemberID`,`member`.`Name`,`member`.`Email`, `part_of`.`Status` 
                FROM `part_of` LEFT JOIN `member`ON `member`.`MemberID`= `part_of`.`MemberID` 
                WHERE `GroupID`=?";
        $stmt =  mysqli_stmt_init($conn);

        $membersAccepted = array();
        $membersWaiting = array();
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror2");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $groupID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while($member = mysqli_fetch_assoc($result)){
            if($member['Status']=="In Progress"){
                array_push($membersWaiting,$member);
            }else{
                array_push($membersAccepted,$member);
            }
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
        <?php if($groupInfo['Owner']!=$_SESSION['MemberID']){ ?>
            <?php if(isPartOfGroup($membersWaiting, $membersAccepted,$_SESSION['MemberID']) != 2) {?>
                <form method="POST" action="./JoinGroup.inc.php">
                    <input type="hidden" name="group_id" value="<?php echo $groupID; ?>">
                    <input type="hidden" name="member_id" value="<?php echo $_SESSION['MemberID']; ?>">
                    <input type="submit" name="JoinGroup" class="btn btn-outline-success m-2" <?php echo (isPartOfGroup($membersWaiting, $membersAccepted,$_SESSION['MemberID']) == 1)?'value="Request Sent" disabled':'value="Join Group"' ?>>
                </form>
            <?php } else{?>
                <form method="post" action="./LeaveGroup.inc.php">
                    <input type="hidden" name="group_id" value="<?php echo $groupID; ?>">
                    <input type="hidden" name="member_id" value="<?php echo $_SESSION['MemberID']; ?>">
                    <input type="submit" name="LeaveGroup" value="Leave Group" class="btn btn-outline-secondary m-2">
                </form>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="card">
        <h1 class="card-header">
            <?php echo $groupInfo['GroupName']?>
        </h1>
        <div class="card-body">
            <p>Created By: <?php echo $groupInfo['Name']?></p>
            <p>Email: <?php echo $groupInfo['Email']?></p>
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

    <?php if($groupInfo['Owner']==$_SESSION['MemberID'] && sizeof($membersWaiting)>0){ ?>
        <div class="card mt-5">
            <h1 class="card-header">
                Request To Join Group
            </h1>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php foreach($membersWaiting as $member){?>
                        <li class="list-group-item">
                            <p>Name: <?php echo $member['Name']?></p>
                            <p>Email: <?php echo $member['Email']?></p>
                            <div class="d-flex justify-content-between">
                                <form method="post" action="./AcceptRequest.inc.php">
                                    <input type="hidden" name="group_id" value="<?php echo $groupID; ?>">
                                    <input type="hidden" name="member_id" value="<?php echo $member['MemberID']; ?>">
                                    <input type="submit" name="AcceptRequest" value="Accept" class="btn btn-outline-success m-2">
                                </form>
                                <form method="post" action="./LeaveGroup.inc.php">
                                    <input type="hidden" name="group_id" value="<?php echo $groupID; ?>">
                                    <input type="hidden" name="member_id" value="<?php echo $member['MemberID']; ?>">
                                    <input type="submit" name="LeaveGroup" value="Refuse" class="btn btn-outline-danger m-2">
                                </form>
                            </div>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    <?php }?>

    <div class="card mt-5">
        <h1 class="card-header">
            List of Members
        </h1>
        <ul class="list-group list-group-flush">
            <?php foreach($membersAccepted as $member){
                if($groupInfo['Owner'] !=$member['MemberID']){
                ?>
                <li class="list-group-item">
                    <p>Name: <?php echo $member['Name']?></p>
                    <p>Email: <?php echo $member['Email']?></p>
                </li>
            <?php }
                }?>
        </ul>
    </div>

</div>

<?php include 'footer.php'; ?>