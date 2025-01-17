<?php
/*Written By: Israt Noor Kazi (40029299),
            Miled Chalal-Henri (26685900),
            Omar Hammoud (40002184)
*/
?>
<?php include 'header.php'; ?>

<?php if (isset($_GET['success'])) {
    $success = unserialize(urldecode($_GET['success']));
?>
    <div class="alert alert-success">
        <strong>Success!</strong> <?php echo $success['signup']; ?>
    </div>
<?php } ?>

<div style="position: absolute;
    right:20px;">
    <label>Sort By:</label>
    <form method="POST" onload="this.form.submit();">
        <select name="sortby" onchange="this.form.submit();">
            <option value="latest" selected="selected">Latest</option>
            <option value="oldest">Oldest</option>
            <option value="popular">Most Popular</option>
        </select>
    </form>
</div>

<div class="container" style="width: 50em;">
    <?php

    require "dbh.inc.php";
    if (isset($_POST['sortby'])) {
        if ($_POST['sortby'] === "latest") {
            $sql = "SELECT c.ContentID, c.MemberID, c.ContentBody,c.Date, m.Name,  c.Image, c.Type='public' as type, p.ContentID as priv_con, p.Memberid as priv_mem, t.Title FROM content c LEFT JOIN member m ON c.MemberID=m.MemberID LEFT JOIN private_content p ON c.ContentID=p.ContentID LEFT JOIN event_poll t ON c.ContentID=t.ContentID ORDER BY Date DESC";
        } else if ($_POST['sortby'] === "oldest") {
            $sql = "SELECT c.ContentID, c.MemberID, c.ContentBody,c.Date, m.Name, c.Image, c.Type='public' as type, p.ContentID as priv_con, p.Memberid as priv_mem, t.Title  FROM content c LEFT JOIN private_content p ON c.ContentID=p.ContentID LEFT JOIN member m ON c.MemberID=m.MemberID LEFT JOIN event_poll t ON c.ContentID=t.ContentID ORDER BY Date ASC";
        } else if ($_POST['sortby'] === "popular") {
            $sql = "SELECT c.ContentID, c.MemberID, c.ContentBody,c.Date, m.Name, c.Image,  c.Type='public' as type ,  COUNT(o.ContentID) AS totalcomments , p.ContentID as priv_con, p.Memberid as priv_mem, t.Title FROM content c  LEFT JOIN private_content p ON c.ContentID=p.ContentID LEFT JOIN member m ON c.MemberID=m.MemberID  LEFT JOIN comment o ON c.ContentID=o.ContentID LEFT JOIN event_poll t ON c.ContentID=t.ContentID GROUP BY c.ContentID ORDER BY totalcomments DESC";
        }
    } else {
        $sql = "SELECT c.ContentID, c.MemberID, c.ContentBody,c.Date, m.Name,  c.Image, c.Type='public' as type, p.ContentID as priv_con, p.Memberid as priv_mem , t.Title FROM content c LEFT JOIN member m ON c.MemberID=m.MemberID LEFT JOIN private_content p ON c.ContentID=p.ContentID LEFT JOIN event_poll t ON c.ContentID=t.ContentID ORDER BY Date DESC";
    }
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    } else {
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $contentIDList = array();
            while ($row = $result->fetch_assoc()) {
                //shows public posts
                if ($row["type"] == 1 || ($row["type"] == 0 && isset($_SESSION['MemberID']) &&$row["priv_mem"] == $_SESSION["MemberID"])) {
                    $contentID = $row["ContentID"];
                    $_SESSION["contentID"] = $contentID;
                    array_push($contentIDList, $contentID);
    ?>

                    <div id="divID">
                        <p id="pID">
                            <span style="font-size:50px;">👤</span>

                            <?php echo ($row['Name']) ?>
                        </p>
                        <br>
                        <h5 id="h1ID"><?php echo ($row['ContentBody']) ?></h5>

                        <?php if ($row['Image'] != NULL) {
                            echo '<img id="imageID" src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '"/>';
                        } ?>

                        <br>
                        <br>
                        <!--Format for a comment -->
                        <form class='comment-form'>
                            <textarea placeholder="Write a comment..." class="commentTextArea" name="commentBody" onkeyup="textAreaAdjust(this)"></textarea>
                            <br>
                            <input type="hidden" name="contentID" value=<?php echo $contentID; ?>>
                            <input type="submit">
                        </form>


                        <!--Display comments after fetch data -->
                        <div id=<?php echo 'comments_list_' . $contentID; ?> onload="displayAllComments(<?php echo $contentID; ?>)">

                        </div>

                        <?php

                        require "dbh.inc.php";
                        $contentID = $_SESSION["contentID"];
                        $sql = "SELECT `event_poll_optionID`, `ContentID`, `Place`, `Date`, `Time` FROM `event_poll_option` WHERE `ContentID`=?";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ./index.php?error=sqlerror1");
                            exit();
                        }

                        mysqli_stmt_bind_param($stmt, "i", $contentID);
                        mysqli_stmt_execute($stmt);
                        $options = mysqli_stmt_get_result($stmt);
                        $nbrow = mysqli_num_rows($options);
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);


                        ?>

                        <?php if ($nbrow > 0) { ?>
                            <!--Format for a poll -->
                            <div id=<?php echo 'event_poll_' . $contentID ?>>
                                <h3>

                                    <?php echo ($row['Title']) ?>

                                </h3>
                                <!--Format for a poll form-->
                                <form class="event_poll_form">
                                    <?php while ($option = mysqli_fetch_assoc($options)) { ?>
                                        <div>
                                            <input type="radio" name="vote" value=<?php echo $option['event_poll_optionID'] ?>>
                                            <label>
                                                <?php echo $option['Date']; ?>
                                                <br>
                                                <?php echo $option['Time']; ?>
                                                <br>
                                                <?php echo $option['Place']; ?>
                                                <br>
                                            </label>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" name="contentID" value="<?php echo $contentID; ?>">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                                </form>
                            </div>
                        <?php } ?>
                    </div>
    <?php }
            }
        }
    } ?>

    <?php include 'footer.php'; ?>

    <script>
        function VisibilityMethod() {
            alert(this);
            if (this.style.display === "none") {
                this.style.display = "block";
            } else {
                this.style.display = "none";
            }
        }

        function textAreaAdjust(element) {
            element.style.height = "1px";
            element.style.height = (25 + element.scrollHeight) + "px";
        }


        $(document).ready(function() {

            <?php foreach ($contentIDList as $id) { ?>
                displayAllComments(<?php echo $id ?>)
            <?php } ?>

            $(".comment-form").submit(function(event) {
                event.preventDefault(); //prevent default action
                var form_data = $(this).serialize(); //Encode form elements for submission
                $(this).find('textarea').val("");

                $.post('./postComment.inc.php', form_data, function(response) {
                    var data = JSON.parse(response);

                    if ('err' in data) {
                        alert(data.err);
                    } else {
                        displayAllComments(data['contentID']);
                    }
                });
            });

            function displayAllComments(contentID) {

                $.get('./displayComments.inc.php?cid=' + contentID, function(response) {
                    $("#comments_list_" + contentID).html(response);
                })
            }

            $(".event_poll_form").submit(function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();

                $.post('./poll_vote.php', form_data, function(response) {
                    var data = JSON.parse(response)
                    if ('err' in data) {
                        alert(data.err);
                    } else {
                        displayPollResults(data['contentID']);
                    }
                });
            });



            function displayPollResults(contentID) {

                $.get('./display_poll_results.php?cid=' + contentID, function(response) {
                    $("#event_poll_" + contentID).html(response);
                })
            }
        });
    </script>