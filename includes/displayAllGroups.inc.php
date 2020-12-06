<?php
    session_start();
    if(isset($_SESSION['MemberID']) && isset($_REQUEST) ){
        require "dbh.inc.php";
        $request = $_GET['request'];
        $memberID = $_SESSION['MemberID'];

        if($request == 1){
        $sql = "SELECT `GroupID`, `GroupName`, `Date`, `member`.`Name` 
                FROM `group`LEFT JOIN `member` ON `group`.`Owner`=`member`.`MemberID` 
                WHERE `group`.`Owner`<>? AND `GroupID` NOT IN (SELECT `part_of`.`GroupID` 
                                                                FROM `part_of` 
                                                                WHERE `part_of`.`MemberID`=? AND `part_of`.`Status`= 'Accepted')";
        
        }elseif($request == 2){
        $sql = "SELECT `GroupID`, `GroupName` 
                FROM `group` 
                WHERE `Owner`=?";

        }elseif($request==3){

            $sql = "SELECT `GroupID`, `GroupName`, `Owner` 
                    FROM `group` 
                    WHERE `group`.`Owner`<>? AND `group`.`GroupID` IN (SELECT `part_of`.`GroupID` 
                                                                        FROM `part_of` 
                                                                        WHERE `part_of`.`MemberID`=? AND `part_of`.`Status`= 'Accepted')";

        }else{
            echo "Error: Cannot fetch groups.";
            exit();
        }
        
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
            }
        
        if($request==2 ){
            mysqli_stmt_bind_param($stmt, "i",$memberID);
        }else{
            mysqli_stmt_bind_param($stmt, "ii",$memberID,$memberID);
        }
        
        mysqli_stmt_execute($stmt);
        $groups = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
 
    }else{
        echo "Error: Cannot view all groups.";
    }
?>

<?php if($request ==1){ ?>
    <tr>
        <th scope="col">Group Name</th>
        <th scope="col">Date</th>
        <th scope="col">Created By</th>
        <th></th>
    </tr>
    <?php while($group = mysqli_fetch_assoc($groups)){ ?>
        <tr>
            <td><?php echo $group['GroupName'] ;?></td>
            <td><?php echo $group['Date'] ;?></td>
            <td><?php echo $group['Name'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showGroup.php?id=<?php echo $group['GroupID']; ?>">More Info</a></td>			
        </tr>
    <?php }?>
<?php }elseif($request ==2){ ?>

    <?php while($group = mysqli_fetch_assoc($groups)){ ?>
        <li class="list-group-item">
                <?php echo $group['GroupName'] ;?>
            <span class="float-right"><a class="btn btn-outline-info" href="./showGroup.php?id=<?php echo $group['GroupID']; ?>">More Info</a></span>			
        </li>
    <?php }?>

<?php }elseif($request =3){ ?>
    <?php while($group = mysqli_fetch_assoc($groups)){ ?>
        <li class="list-group-item">
                <?php echo $group['GroupName'] ;?>
            <span class="float-right"><a class="btn btn-outline-info" href="./showGroup.php?id=<?php echo $group['GroupID']; ?>">More Info</a></span>			
        </li>
    <?php }?>
<?php }?>