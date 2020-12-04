<?php
   /*Written By: Omar Hammoud (40002184)
   */
?>
<?php
session_start();
if (isset($_POST['editInfo-submit'])) {
    require "dbh.inc.php";
    $memberID = $_SESSION['MemberIDChange'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $privilege = $_POST['privilege'];
    $password = $_POST['password'];

    $sql ="UPDATE member SET Email = ?, Name = ?, Address = ?, Status = ?, Privilege = ? Password = ? WHERE MemberID = $memberID";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../includes/signup.php?error=sqlerror1");
    }
    else {
        mysqli_stmt_bind_param($stmt, "ssssss", $email, $name, $address, $status, $privilege, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    header("Location: ../includes/signup.php?Member_info_changed".$memberID.$name);

}



