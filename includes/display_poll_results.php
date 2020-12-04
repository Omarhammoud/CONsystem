<?php
    if(isset($_GET['cid'])){
        require "dbh.inc.php";
        
        $contentID = $_GET['cid'];

        $sql = "SELECT `Title` FROM `event_poll` WHERE `ContentID`=?";
        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "error=sqlerror1";
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i",$contentID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $contentTitle = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        $sql='SELECT  `Place`, `Date`, `Time`, 
        COUNT(`vote`.`MemberID`)*100/(
            SELECT COUNT(*)
            FROM `vote`
            WHERE `vote`.`ContentID`=?) AS percentage
        FROM `event_poll_option`
        LEFT JOIN `vote`ON `event_poll_option`.`event_poll_optionID`=`vote`.`event_poll_optionID`
        WHERE `event_poll_option`.`ContentID`=?
        GROUP BY `event_poll_option`.`event_poll_optionID`';

        $stmt =  mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "error=sqlerror2";
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "ii",$contentID,$contentID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $poll_results = array();
        while($value = mysqli_fetch_assoc($result)){
            array_push($poll_results, $value);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);



    }else{
        echo "Failed";
    }
?>
<h4 class="mb-3"><?php echo $contentTitle['Title']?></h4>
<dl class="row">
    <?php foreach ($poll_results as $option) {?>
        <dt class="col-sm-3">Place: </dt>
        <dd class="col-sm-9"><?php echo $option['Place'];?></dd>
        
        <dt class="col-sm-3">Date: </dt>
        <dd class="col-sm-9"><?php echo $option['Date'];?></dd>

        <dt class="col-sm-3">Time: </dt>
        <dd class="col-sm-9"><?php echo date("H:i a",strtotime($option['Time']));?></dd>
        
        <dd class="col-sm-12 mb-5">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo number_format($option['percentage'],1);?>%;" aria-valuenow="<?php echo number_format($option['percentage'],1);?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($option['percentage'],1);?>%</div>
            </div>
        </dd>   
    <?php } ?>
<dl>
