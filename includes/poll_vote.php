<?php
  //  Written By: Israt Noor Kazi (40029299)
  session_start();
  $data = array();

  if(isset($_SESSION['MemberID'])){
    if(isset($_POST['contentID']) && isset($_POST['vote'])){
      require "dbh.inc.php";

      $userid = $_SESSION['MemberID'];
      $contentid = $_POST['contentID'];
      $oid = $_POST['vote'];
       
      $stmt = mysqli_stmt_init($conn);
      $sql = "INSERT INTO `vote`(`event_poll_optionID`, `ContentID`, `MemberID`) VALUES (?,?,?)";
      
      if (!mysqli_stmt_prepare($stmt,$sql)) {

        $data['err'] = "Error: Could not vote.";
        echo json_encode($data);
        exit();
      }
      mysqli_stmt_bind_param($stmt, "iii",$oid,$contentid,$userid); 
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);

      $data['contentID']=$contentid;
      echo json_encode($data);
    }
  }else{
      $data['err'] = "You must be logged in to vote.";
      echo json_encode($data);
  }
?>