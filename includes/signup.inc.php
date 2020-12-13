<?php
//Written By:  Omar Hammoud (40002184)

if(isset($_POST['signup-submit'])) {
    $errors = array();
    require "dbh.inc.php";
    $memberid = $_GET["MemberID2"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $status = "inactive";
    $privilege = "normal member";
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd-second'];

    if(empty($name)){
        $errors['name']="Name is required";
    }

    if(empty($email)){
        $errors['email'] = "Email is required.";
    }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid Email Format";

          }

    }

    if(empty($address)){
        $errors['address']="Address is required";
    }

    if(empty($password)){
        $errors['password']="Password is required";
    }

    if(empty($password2)){
        $errors['password2']="Confirm password is required";
    }

    if($password != $password2){
        $errors['signupMember']= "Passwords do not match";
    }

    if(array_filter($errors)){
        header("Location: ./register.php?errors=".urlencode(serialize($errors)));
        exit();
    } else {
        $sql = "SELECT Email FROM member WHERE Email =? ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./register.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);

            if ($resultcheck > 0) {
                $errors['signupMember']= "User Already Exists";
                header("Location: ./register.php?errors=".urlencode(serialize($errors)));
                exit();
            } else {
                $sql = "INSERT INTO member (Password, Email, Name, Address, Status, Privilege) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ./register.php?error=sqlerror1");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssss", $password, $email, $name, $address, $status, $privilege);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }

            }


        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
   }
}else if (isset($_POST['contractorsignup-submit'])) {
        $errors = array();
        require "dbh.inc.php";
        $memberid = $_GET["MemberID2"];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = "N/A";
        $status = "inactive";
        $privilege = "contractor";
        $password = $_POST['pwd'];
        $password2 = $_POST['pwd-second'];

        if(empty($name)){
            $errors['nameCon']="Name is required";
        }
    
        if(empty($email)){
            $errors['emailCon'] = "Email is required.";
        }else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['emailCon'] = "Invalid Email Format";
    
              }
    
        }
    
        if(empty($password)){
            $errors['passwordCon']="Password is required";
        }
    
        if(empty($password2)){
            $errors['password2Con']="Confirm password is required";
        }
    
        if($password != $password2){
            $errors['signupContractor']= "Passwords do not match";
        }

        if(array_filter($errors)){
            header("Location: ./register.php?errors=".urlencode(serialize($errors)));
            exit();
        }else {
            $sql = "SELECT Email FROM member WHERE Email =? ";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ./register.php?error=sqlerror1");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultcheck = mysqli_stmt_num_rows($stmt);

                if ($resultcheck > 0) {
                    $errors['signupContractor']= "User Already Exist";
                    header("Location: ./register.php?errors=".urlencode(serialize($errors)));
                    exit();
                } else {
                    $sql = "INSERT INTO member (Password, Email, Name, Address, Status, Privilege) VALUES (?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ./register.php?error=sqlerror1");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssssss", $password, $email, $name, $address, $status, $privilege);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                    }

                }


            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

}

$success['signup']="Registration request has been sent. Please wait until an administrator activates your account.";
header("Location: ./MemberDashboard.php?success=".urlencode(serialize($success)));



