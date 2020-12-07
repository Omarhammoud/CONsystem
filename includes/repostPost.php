<?php
    //Written By: Leslie Poso (40057877)
    if(isset($_SESSION['MemberID']) && !empty($_GET['ContentID'])){
        require "dbh.inc.php";
        
        $contentID = $_GET['ContentID'];
        $sql = "SELECT * FROM content, member WHERE content.MemberID = member.MemberID
        AND ContentID = ?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./MemberDashboard.php?error=RepostError");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "i", $contentID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $contentInfo = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        $contentPrivacy = $contentInfo["Type"];
        $contentBody = "Originally Posted By: ". $contentInfo["Name"] . ". "$contentInfo["ContentBody"];
        $contentImg = $contentInfo["Image"];
        $contentTitle = "REPOST: " . $contentInfo["Title"];
        $currentDate = date('Y-m-d');

        $sql = "INSERT INTO content (MemberID, ContentBody, Type, Image, Title, Date)
        VALUES ('$_SESSION['MemberID']', '$contentBody', '$postPrivacy', '$contentImg', '$contentTitle', '$currentDate')";

        if ($conn->query($sql) === TRUE) 
            {
                $ContentID = $conn->insert_id;
            } 
        else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        $sql = "SELECT MemberID from private_content WHERE ContentID = ?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./MemberDashboard.php?error=RepostError");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "i", $contentID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while($listOfIDs = mysqli_fetch_assoc($result)){
            $sql = "INSERT INTO private_content (ContentID, MemberID) VALUES ('$ContentID', '$listOfIDs['MemberID']')";
		    mysqli_query($conn, $sql);
        }

        header("Location: ./MemberDashboard.php?success=RepostSuccesful");    
    }else{
        header("Location: ./MemberDashboard.php?error=MissingParameters"); 
    }
?>