<?php
   //Written By: Omar Hammoud (40002184)
    
?>
<?php
session_start();
require "dbh.inc.php";
$memberid = $_SESSION['MemberID'];
$privilege = $_SESSION['Privilege'];


        if ($privilege == "normal member") {
            $_SESSION['isAdmin'] = false;
            $_SESSION['isMember'] = true;
            $_SESSION['contractor'] = false;
            header("Location: ./index.php?Success=LoddedinAsMember");
            exit();
        } else if ($privilege == "contractor") {
            $_SESSION['isAdmin'] = false;
            $_SESSION['contractor'] = true;
            $_SESSION['isMember'] = false;
            header("Location: ./index.php?Success=LoddedinAsMember");
            exit();
        }else if ($privilege == "administrator") {
            $_SESSION['isAdmin'] = true;
            $_SESSION['isMember'] = true;
            $_SESSION['contractor'] = false;
            header("Location: ./index.php?Success=LoddedinAsAdmin");
            exit();
        }
//    }

?>