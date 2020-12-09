<?php
/**
 * Created by PhpStorm.
 * User: OmarHammoud
 * Date: 2020-12-09
 * Time: 00:08
 */
include "./header.php";
?>
<form action="resetPassword.inc.php" method="post">
    <input type="password" name="pwd" placeholder="Password" >
    <button type="submit" name="change-pwd-submit">Change Password</button>
</form>
<?php
$_SESSION["ChangePwdID"] = $_GET["MemberID2"];
?>