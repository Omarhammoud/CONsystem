<?php 
    include "./header.php"
?>
<?php if(isset($_SESSION['MemberID'])){?>
    <h1>Create Group</h1>
    <form action="./createGroup.inc.php" method="post">
        <input type="text" name="GroupName" require="required" placeholder="Group Name" />
        <input type="submit" name="CreateGroup" value="Create Group">
    </form>

<?php } else{?>
<h1>Need to logged in</h1>
<?php }?>

<?php 
    include "./footer.php"
?>
