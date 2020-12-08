<?php
//Written By:  Omar Hammoud (40002184)
session_start();
include "header.php";
if(isset($_GET['MemberID1'])) {
    require "dbh.inc.php";
    $memberID = $_GET['MemberID1'];
    $_SESSION['MemberIDChange']= $memberID;
    $sql = "SELECT Email, Name, Address, Status, Privilege FROM member WHERE MemberID = ? ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./UserEdit.inc.php?error=sqlerror1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $memberID);
        mysqli_stmt_execute($stmt);
        $resultcheck = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_array($resultcheck, MYSQLI_ASSOC)) {
            $email = $row['Email'];
            $name = $row['Name'];
            $address = $row['Address'];
            $status = $row['Status'];
            $privilege = $row['Privilege'];
            $password = $row['Password'];
        }


    }
    echo '<form action="EditInfo.inc.php" method="post">
      <input type="text" name="name" placeholder="Name" value="' . $name . '">
      <input type="text" name="email" placeholder="Email"  value="' . $email . '">
      <input type="text" name="address" placeholder="Address" value="' . $address . '">
      <select name="status" ><option value="active">active</option>
                <option value="inactive">inactive</option>
                </select>
<select name="privilege" ><option value="normal member">normal member</option>
                <option value="administrator">administrator</option>
                </select>
      <input type="password" name="password" placeholder="Password" value="' . $password . '">
 <button type="submit" name="editInfo-submit">Edit Information</button>
</form>';



}