<?php
if(isset($_POST['login-submit'])) {
    require "dbh.inc.php";

    $username = $_POST['memberid'];
    $password = $_POST['pwd'];

    if(empty($username) || empty($password)){
        header("Location: ./index.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT MemberID FROM Member WHERE MemberID =? ";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./index.php?error=sqlerror1");
            exit();
         }
        else{
            mysqli_stmt_bind_param($stmt, "i",$username);
            mysqli_stmt_execute($stmt);
            $resultcheck = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($resultcheck)){
            $pwdcheck = password_verify($password,$row['Password']);
            if($pwdcheck = false){
                header("Location: ./index.php?error=WrongPassword");
                exit();
            }
            else if($pwdcheck = true){
                session_start();
                $_SESSION['MemberID'] = $row['MemberID'];
                $_SESSION['Name'] = $row['Name'];
                header("Location: ./index.php?success=LoggedIn");
                exit();

            }
            else{
                header("Location: ./index.php?error=WrongPassword");
                exit();
            }

            }
            else{
                header("Location: ./index.php?error=MemberDoesNotExist");
                exit();
            }

        }
    }


}