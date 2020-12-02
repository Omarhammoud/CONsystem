<?php
  session_start();
  
  if(isset($_SESSION['MemberID']) && isset($_GET['oid'])){
        require "dbh.inc.php";

        $userid = $_SESSION['MemberID'];
        $oid = $_GET['oid'];
        
        $sql = "SELECT `ContentID` FROM `event_poll_option` WHERE `event_poll_optionID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./GroupPage.php?error=sqlerror1");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i",$oid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $optionInfo = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        $contentid = $optionInfo['ContentID'];
        
        
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT INTO `vote`(`event_poll_optionID`, `ContentID`, `MemberID`) VALUES (?,?,?)";
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {

          header("Location: ./GroupPage.php?error=sql2");
          exit();
        }
        mysqli_stmt_bind_param($stmt, "iii",$oid,$contentid,$userid); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        echo true;
  }else{
    echo 'Error';
  }
?>
