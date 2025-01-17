<?php
   /*Written By: Israt Noor Kazi (40029299)
   */
?>
<?php
    session_start();
    if(isset($_POST['edit_id']) && isset($_POST['GroupName'])){
        require "dbh.inc.php";
        require "functions.inc.php";

        
        $groupID = $_POST['edit_id'];
        $groupName = $_POST['GroupName'];

        if(checkGroupName($groupName)){
            echo 'Group name already exists.';
        }else{
            $sql = "UPDATE `group` SET `GroupName`=? WHERE `GroupID`=?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ./GroupPage.php?error=sqlerror1");
                exit();
                }

            mysqli_stmt_bind_param($stmt, "si",$groupName,$groupID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            echo 'Group name changed to: '.$groupName;
        }

    }else{
        echo 'Failed to change group name.';
    }
?>