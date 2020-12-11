<?php
//Written By:  Omar Hammoud (40002184)
if(isset($_POST['signup-submit'])) {
    require "dbh.inc.php";
    $memberid = $_GET["MemberID2"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $status = "inactive";
    $privilege = "normal member";
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd-second'];

    if (empty($name) || empty($email) || empty($address) || empty($status) || empty($password) || empty($password2)) {
        header("Location: ./register.php?error=emptyfields");
        exit();

    } else if (!filter_var($email, FILTER_VALIDATE_DOMAIN) && !preg_match("/^[a-zA-Z0-9]*$/", Address)) {
        header("Location: ./register.php?error=emailanduserandAddressIdNotvalid");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_DOMAIN)) {
        header("Location: ./register.php?error=emailNotvalid");
        exit();
    }
//    else if(!preg_match("/^[a-zA-Z0-9]*$/",Address)) {
//            header("Location: ../includes/signup.php?error=AddressNotvalid");
//            exit();
//    }
    else if ($password != $password2) {
        header("Location: ./register.php?error=passwordsDontMatch");
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
                header("Location: ./register.php?error=useridTaken");
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
    }}else if (isset($_POST['contractorsignup-submit'])) {
        require "dbh.inc.php";
        $memberid = $_GET["MemberID2"];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = "N/A";
        $status = "inactive";
        $privilege = "contractor";
        $password = $_POST['pwd'];
        $password2 = $_POST['pwd-second'];

        if (empty($name) || empty($email) || empty($status) || empty($password) || empty($password2)) {
            header("Location: ./register.php?error=emptyfields");
            exit();

        } else if (!filter_var($email, FILTER_VALIDATE_DOMAIN)) {
            header("Location: ./register.php?error=emailNotvalid");
            exit();
        } else if ($password != $password2) {
            header("Location: ./register.php?error=passwordsDontMatch");
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
                    header("Location: ./register.php?error=useridTaken");
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


    header("Location: ./MemberDashboard.php?Account_Created");



