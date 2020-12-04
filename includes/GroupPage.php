<?php
   /*Written By: Israt Noor Kazi (40029299)
   */
?>
<?php include 'header.php'; ?>

<?php
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";
        
        $sql = "SELECT * FROM `group`";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
            }

        mysqli_stmt_execute($stmt);
        $groups = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);        
 
    }else{
        header("Location:./index.php");
    }
?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card" style="	height: 400px; width: 100%;" >
                <div class="card-header">
                        <h3>My Groups</h2>
                </div>
                <div class="overflow-auto" style="	height: 80%; width: 100%;">
                                
                    <ul class="list-group list-group-flush" id="groupOwned">

                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-center p-0">
                    <form id="CreateGroupForm" class="form-inline m-0" action="./createGroup.inc.php" method="post">
                        <input id="GroupName" type="text"  class="form-control" name="GroupName" require="required" placeholder="Group Name" />
                        <input class="btn btn-outline-primary m-3" type="submit" name="CreateGroup" value="Create Group">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card" style="	height: 400px; width: 100%;" >
                <div class="card-header" >
                        <h3>Joined Groups</h2>
                </div>
                <div class="overflow-auto" style="	height: 200px; width: 100%;">
                                
                    <ul class="list-group list-group-flush" id="joinedGroup">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
        <div class="card mt-3" style="width: 70%;">
            <div class="card-header">
                <h3>List of All Group</h2>
            </div>
            <table class="table" id="allGroups">

            </table>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

<script>

$(document).ready(function(){

    displayAllGroups(1)
    displayAllGroups(2)
    displayAllGroups(3)

$("#CreateGroupForm").submit(function(event){
   event.preventDefault(); //prevent default action
   var form_data = $(this).serialize(); //Encode form elements for submission
   $(this).find('#GroupName').val("");
   console.log(form_data);

   $.post( './createGroup.inc.php', form_data, function( response ) {
        var data = JSON.parse(response);
         
       if('err' in data){
           alert(data.err);
        }else{
            displayAllGroups(data['request']);
        }
     });
  });

function displayAllGroups(request){

   $.get('./displayAllGroups.inc.php?request='+request,function(response){
       if(request==1){
            $("#allGroups").html(response);
        }else if(request==2){
            $("#groupOwned").html(response);
        }else if(request == 3){
            $("#joinedGroup").html(response);
        }   
  })
}

});

</script>