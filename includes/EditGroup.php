<!--
   Written By: Israt Noor Kazi (40029299)
-->
<?php include "./header.php" ?>

<?php
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";

        //Fetch Group Name  
        $groupID = $_GET["id"];
        $sql = "SELECT `GroupName`, `Owner` FROM `group` WHERE `GroupID`=?";
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
<div class="container">
    <h1>Edit Page</h1>
    <a class="btn btn-outline-primary" href="./showGroup.php?id=<?php echo $groupID; ?>">Finish</a>
    <form action="./EditGroup.inc.php" method="post" class="form-inline mb-4">
        <div class="form-group">
        <input class="form-control mr-2" type="text" name="GroupName" value="<?php echo $groupInfo['GroupName']?>" />
        <input type="hidden" name="edit_id" value="<?php echo $groupID; ?>">
        <input type="submit" name="EditGroup" value="Save Group Name" class="btn btn-outline-success m-2">
        </div>
    </form>

    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($memberInfo as $member){
            if($groupInfo['Owner'] !=$member['MemberID']){
        ?>
            <tr>
                <td><?php echo $member['Name'];?></td>
                <td><?php echo $member['Email'];?></td>
                <td>                    
                    <form method="post" action="./LeaveGroup.inc.php">
                        <input type="hidden" name="group_id" value="<?php echo $groupID ; ?>">
                        <input type="hidden" name="member_id" value="<?php echo $member['MemberID']; ?>">
                        <input type="submit" name="DeleteMember" value="Delete" class="btn btn-outline-danger m-2">
                    </form>
                </td>
            </tr>
            <?php }
            }?>
    </tbody>
    </table>
</div>
<?php include "./footer.php" ?>