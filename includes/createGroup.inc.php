<?php
   /*Written By: Israt Noor Kazi (40029299)
   */
?>
<?php
    session_start();
    $data= array();
    if(isset($_SESSION['MemberID'])){
        if(!empty($_POST['GroupName'])){   
            
            require "dbh.inc.php";
            date_default_timezone_set("America/Montreal");

            $groupName = $_POST['GroupName'];
            $owner = $_SESSION["MemberID"];
            $currentDate = date('Y-m-d');

            $stmt = mysqli_stmt_init($conn);
            $sql = "INSERT INTO `group`(`GroupName`, `Date`, `Owner`) VALUES (?,?,?)";
            
            if (!mysqli_stmt_prepare($stmt,$sql)) {

                $data['err']="Cannot fetch groups";
                echo json_encode($data);
                exit();
            } 
                    
            mysqli_stmt_bind_param($stmt, "ssi",$groupName, $currentDate, $owner);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            $data['request']="2";
            echo json_encode($data);
            exit();
            
        }else{
            $data['err']="Failed to submit group form";
            echo json_encode($data);
            exit();
        }
    }else{
        $data['err']="User must be logged in to view groups";
        echo json_encode($data);
        exit();
    }
?>