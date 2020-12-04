<?php
   
    if(isset($_GET['cid'])){
        require "dbh.inc.php";
        $contentID = $_GET["cid"];
        $sql = "SELECT `Name`, `CommentBody`, `Date` FROM `comment`
                LEFT JOIN `member`ON `member`.`MemberID`= `comment`.`MemberID`
                WHERE `ContentID` =?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){

            $data['err'] = "Faild to prepare query 1";
            echo json_encode($data);
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i",$contentID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $comments = array();
        while($comment = mysqli_fetch_assoc($result)){
            array_push($comments, $comment);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    
    }else{

        
        echo "Content ID not found.";
        exit();
    }
?>

<?php foreach($comments as $comment){ ?>
    <div class="commentDiv">
        <h6 class="commentOwner">
            <span class="commentImg" style="margin-left: 10px;background-color: #8c7878;border-radius: 79px;">👤</span>
            <?php echo $comment['Name'] ?>
        </h6>
        <h4 class="comment">
            <?php echo $comment['CommentBody'] ?>
            <br>
            <footer class="blockquote-footer"><?php echo $comment['Date'] ?></footer>
        </h4>
        
    </div>
<?php } ?>

