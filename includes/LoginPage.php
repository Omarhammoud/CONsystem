<!--
   Written By:  Omar Hammoud (40002184)
    
-->
<?php include 'header.php'; ?>
<form action="./login.inc.php" method="post">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="pwd" placeholder="Password">
    <button type="submit" name="login-submit">Login</button>
</form>
<?php include 'footer.php'; ?>