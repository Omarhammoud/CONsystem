<?php
   //Written By: Israt Noor Kazi (40029299)
?>
<?php
 
//Function check of the user is part of the group
function isPartOfGroup($membersWaiting,$membersAccepted,$memberID){
    foreach ($membersAccepted as $id){
        if (isset($id["MemberID"]) && $id["MemberID"] == $memberID ){

            return 2; // Member is accepted in the group
        }      
    }
    
    foreach ($membersWaiting as $id){
        if (isset($id["MemberID"]) && $id["MemberID"] == $memberID ){

            return 1; // Member send a request which is in progress 
        }      
    }
    return 0; // Member is not part of group
}

//Function check of the group name exists
function checkGroupName($groupName){
    require "dbh.inc.php";

    $nameExist =false;
    $sql = "SELECT * FROM `group` WHERE `GroupName`= ?";
    $stmt =  mysqli_stmt_init($conn);


    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ./GroupPage.php?error=sqlerror1");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s",$groupName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_num_rows($result);

    if($row>0){
        $nameExist = true;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $nameExist;
}

?>