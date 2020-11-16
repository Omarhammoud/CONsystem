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
    <h1>Group Page</h1>
    <table class="table">
        <tr>
            <th scope="col">Group Name</th>
            <th scope="col"></th>
        </tr>
        <?php while($group = mysqli_fetch_assoc($groups)){ ?>
        <tr>
            <td><?php echo $group['GroupName'] ;?></td>
            <td> <a class="btn btn-outline-info" href="./showGroup.php?id=<?php echo $group['GroupID']; ?>">Read More</a></td>			
        </tr>
        <?php }?>
    </table>

    <form class="form-inline" action="./createGroup.inc.php" method="post">
        <input type="text"  class="form-control" name="GroupName" require="required" placeholder="Group Name" />
        <input class="btn btn-outline-primary m-3" type="submit" name="CreateGroup" value="Create Group">
    </form>

</div>
<?php include 'footer.php'; ?>