<?php
    if(isset($_GET['gid']) && isset($_GET['owner'])){
        require "dbh.inc.php";
        $groupID = $_GET['gid'];
        $owner =$_GET['owner'];

         //Fetch Members Information 
        $sql = 'SELECT `part_of`.`MemberID`, `member`.`Name`, `member`.`Email` 
                FROM `part_of` LEFT JOIN `member` ON `part_of`.`MemberID`=`member`.`MemberID` 
                WHERE `part_of`.`GroupID`=? AND `part_of`.`MemberID`<>?';
            
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ii",$groupID,$owner);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_num_rows($result);
        if($row>0){
            $membersInfo = array();
            while($member = mysqli_fetch_assoc($result)){
                array_push($membersInfo, $member);
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
?>

<?php if($row>0){ ?>
    <?php foreach($membersInfo as $member){ ?>
            <tr>
                <td><?php echo $member['Name'];?></td>
                <td><?php echo $member['Email'];?></td>
                <td>                    
                    <form class="deleteMemberForm">
                        <input type="hidden" name="group_id" value="<?php echo $groupID ; ?>">
                        <input type="hidden" name="member_id" value="<?php echo $member['MemberID']; ?>">
                        <input type="submit" name="DeleteMember" value="Delete" class="btn btn-outline-danger m-2">
                    </form>
                </td>
            </tr>
    <?php } ?>
<?php }else{ ?>
    
    <h3>Currently, there are no members in your group.</h3>
    
<?php } ?>