<?php include 'header.php'; ?>

<?php
    if(isset($_SESSION['MemberID'])){
        require "dbh.inc.php";
        
        $sql = "SELECT * FROM `group`";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./includes/GroupPage.php?error=sqlerror1");
            exit();
            }else{
            mysqli_stmt_execute($stmt);
            $groups = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
            
    }
?>

<h1>Group Page</h1>
<table>
    <tr>
        <td>Group Name</td>
        <td>Date Created</td>
    </tr>
    <?php while($group = mysqli_fetch_assoc($groups)){ ?>
    <tr>
        <td><?php echo $group['GroupName'] ;?></td>
        <td><?php echo $group['Date'] ;?></td>
        <td> <a class="btn btn-default" href="./showGroup.php?id=<?php echo $group['GroupID']; ?>">Read More</a></td>			
    </tr>
    <?php }?>
</table>
<?php include 'footer.php'; ?>