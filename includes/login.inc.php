<?php

//Written By:  Omar Hammoud (40002184)
if(isset($_POST['login-submit'])) {
    require "dbh.inc.php";

    $username = $_POST['email'];
    $password = $_POST['pwd'];

    if(empty($username) || empty($password)){
        header("Location: ./LoginPage.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT Email, MemberID, Name FROM member WHERE Email =? ";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./LoginPage.php?error=sqlerror1");
            exit();
         }
        else{
            mysqli_stmt_bind_param($stmt, "s",$username);
            mysqli_stmt_execute($stmt);
            $resultcheck = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($resultcheck)){
            $pwdcheck = password_verify($password,$row['Password']);
            if($pwdcheck = false){
                header("Location: ./LoginPage.php?error=WrongPassword");
                exit();
            }
            else if($pwdcheck = true){
                session_start();
                $_SESSION['MemberID'] = $row['MemberID'];
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['Name'] = $row['Name'];
                header("Location: ./isadmin.inc.php");
                exit();

            }
            else{
                header("Location: ./LoginPage.php?error=WrongPassword");
                exit();
            }

            }
            else{
                header("Location: ./LoginPage.?error=UserDoesNotExist");
                exit();
            }

        }
    }


}