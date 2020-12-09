<?php
/*Written By: Omar Hammoud (40002184),
               Israt Noor Kazi (40029299)
*/
if (isset($_POST['login-submit'])) {
    $errors = array();
    require "dbh.inc.php";
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    if(empty($email)){
        $errors['email'] = "Email is required.";
    }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid Email Format";
          }
    }

    if(empty($password)){
        $errors['password'] = "Password is required.";
    }

    if(array_filter($errors)){
        header("Location: ./LoginPage.php?errors=".urlencode(serialize($errors)));
        exit();
    }else{
        
        $sql = "SELECT Email, MemberID, Name, `Password` FROM member WHERE Email =? ";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./LoginPage.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $resultcheck = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($resultcheck)) {
                $pwdcheck = password_verify($password, password_hash($row['Password'], PASSWORD_DEFAULT));
                if ($pwdcheck == false) {
                    $errors["user"]="Password Is Invalid";
                    header("Location: ./LoginPage.php?errors=".urlencode(serialize($errors)));
                    exit();
                } else{
                    session_start();
                    $_SESSION['MemberID'] = $row['MemberID'];
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['Name'] = $row['Name'];
                    header("Location: ./isadmin.inc.php");
                    exit();
                } 
            } else {
                $errors["user"]="Member Does Not Exist";
                header("Location: ./LoginPage.php?errors=".urlencode(serialize($errors)));
                exit();
            }
        }
    }
}
