<?php
    //Written By: Israt Noor Kazi (40029299)
 
    session_start();
    $data = array();
    if(isset($_SESSION['MemberID'])){

      if(isset($_POST['contentID']) && !empty($_POST['commentBody']){
        
        require "dbh.inc.php";
        date_default_timezone_set("America/Montreal");

        $memberID = $_SESSION['MemberID'];
        $contentID = $_POST['contentID'];
        $commentBody = $_POST['commentBody'];
        $currentDate = date('Y-m-d');
       
        $sql = "INSERT INTO `comment`( `MemberID`, `ContentID`, `CommentBody`, `Date`) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt,$sql)) {

            $data['err'] = "Could not post a comment for this content.";
            echo json_encode($data);
            exit();
        }
        mysqli_stmt_bind_param($stmt, "iiss",$memberID,$contentID, $commentBody, $currentDate);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        
        $data['contentID']=$contentID;
        echo json_encode($data);

      }else{
        $data['err'] = "Could not post a comment for this content.";
        echo json_encode($data);
      }
        
    }else{
        $data['err'] = "You must be logged in to post a comment.";
        echo json_encode($data);
    }  
    
    
?>