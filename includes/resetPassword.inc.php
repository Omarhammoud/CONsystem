<?php
/*Written By: Omar Hammoud (40002184)
*/
?>
<?php
session_start();
if (isset($_POST['change-pwd-submit'])) {
    require "dbh.inc.php";
    $memberID = $_SESSION["ChangePwdID"];
    $password = $_POST['pwd'];

    $sql ="UPDATE member SET Password = ? WHERE MemberID = $memberID";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./signup.php?error=sqlerror1");
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    header("Location: ./signup.php?Password_Changed");

}