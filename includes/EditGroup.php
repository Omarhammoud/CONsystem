<?php
   /*Written By: Israt Noor Kazi (40029299)
   */
?>
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
        $row = mysqli_num_rows($result);
        
        if($row>0){
        
            $groupInfo = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

        }else{
            header("Location: ./GroupPage.php?error=GroupNotFound");
        }

    }else{
        header("Location: ./LoginPage.php");
    }
?>
<div class="container">
    <a class="btn btn-outline-primary mb-3" href="./showGroup.php?id=<?php echo $groupID; ?>">Finish</a>
    <form id="EditGroupName" class="form-inline mb-4">
        <div class="form-group">
        <input class="form-control mr-2" type="text" name="GroupName" value="<?php echo $groupInfo['GroupName']?>" />
        <input type="hidden" name="edit_id" value="<?php echo $groupID; ?>">
        <input type="submit" name="EditGroup" value="Save Group Name" class="btn btn-outline-success m-2">
        </div>
    </form> 


    <div class="card">
        <h5 class="card-header">Members Part of Your Group</h5>
        <div class="card-body">
            <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="member-list">
            </tbody>
        </table>
        </div>
    </div>    
</div>

<?php include "./footer.php" ?>

<script>
    $(document).ready(function(){

        displayAllMember(<?php echo $groupID ?>, <?php echo $groupInfo['Owner'] ?>)


        function displayAllMember(groupID, owner){

            $.get('./displayGroupMembers.php?gid='+groupID+"&owner="+owner,function(response){
                $('#member-list').html(response);
            });
        }

        $(".deleteMemberForm").submit(function(event){
            event.preventDefault(); //prevent default action
            var form_data = $(this).serialize(); //Encode form elements for submission

            $.post( "./LeaveGroup.inc.php", form_data, function( response ) {
                displayAllMember(<?php echo $groupID ?>, <?php echo $groupInfo['Owner'] ?>)
                });
        });

        $("#EditGroupName").submit(function(event){
            event.preventDefault(); //prevent default action
            var form_data = $(this).serialize(); //Encode form elements for submission

            $.post( "./EditGroup.inc.php", form_data, function( response ) {
                alert(response);
                });
        });

    });
</script>