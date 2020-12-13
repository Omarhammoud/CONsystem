<?php
/*Written Miled Chalal-Henri (26685900),Omar Hammoud (40002184)
*/
?>
<?php include 'header.php'; ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Financial Status Page</title>
  </head>
  <body>
    <div class="tm-container">
      <div class="tm-text-white tm-page-header-container">
        <h1 class="tm-page-header">financial status</h1>
      </div>
      <div class="tm-main-content">
        <div id="tm-intro-img"></div>

        <!-- Special Contributions -->
        <section class="tm-section">
          <h2 class="tm-section-header">Special Contributions</h2>
          <div class="tm-responsive-table">
            <table>
              <tr class="tm-tr-header">
                <th style="text-align-last: left;">Contributor Name</th>
                <th style="text-align-last: left;">Contribution</th>
              </tr>
			  <?php

    require "dbh.inc.php";
	
	$sql = "SELECT c.MemberID, c.Amount, m.Name as name FROM contributions c LEFT JOIN member m ON m.MemberID=c.MemberID";
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }else {
        $result = $conn->query($sql);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		 $contribution = $row['Amount'];
		 $contributorName   = $row['name'];
		 echo "<tr>";
                echo "<td style='text-align-last: left;'>".$contributorName."</td>";
                echo "<td style='text-align-last: left;'>".$contribution." $</td>";
         echo "</tr>";
		}
		}
		?>
              
            </table>
          </div>
        </section>
          <form action="FinancialStatus.php" method="post" style="margin-left: 200px;">
              <input type ="text" name="amount" placeholder ="Enter Contribution amount"></br>
              <button class="btn btn-outline-primary m-2" type="submit" name="AddAmount-submit">Submit Contribution</button>
          </form>
        <section class="tm-section">
          <h2 class="tm-section-header">Financial Status</h2>
          <div class="tm-special-items">
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-11.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">Budget</span>
                <span class="tm-item-price"> <?php
                    require "dbh.inc.php";
                    $result = mysqli_query($conn, 'SELECT SUM(Amount) as amount  FROM contributions');
                    $row = mysqli_fetch_assoc($result);
                    $Budget = $row['amount'];
                    $result = mysqli_query($conn, 'SELECT SUM(Cost) as amount  FROM contract WHERE Status = "Completed"');
                    $row = mysqli_fetch_assoc($result);
                    $HistoricalRecord = $row['amount'];

                   echo $Budget-$HistoricalRecord  ?> $ </span>
              </figcaption>
            </figure>
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-13.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">Current Fees</span>
				<span class="tm-item-price"> <?php
                    require "dbh.inc.php";
                    $result = mysqli_query($conn, 'SELECT SUM(Cost) as amount  FROM contract WHERE Status = "In Progess" OR Status = "Posted"');
                    $row = mysqli_fetch_assoc($result);
                    $CurrentFees = $row['amount'];
                    echo $CurrentFees ?> $ </span>
              </figcaption>
            </figure>
          </div>
        </section>

        <hr />
        <!-- Historical Record -->
        <section class="tm-section tm-section-small">
          <h2 class="tm-section-header">Historical Record</h2>
          <p style="margin-left: 200px">$
            <?php
            require "dbh.inc.php";
            $result = mysqli_query($conn, 'SELECT SUM(Cost) as amount  FROM contract WHERE Status = "Completed"');
            $row = mysqli_fetch_assoc($result);
            $HistoricalRecord = $row['amount'];
            echo $HistoricalRecord ?>
          </p>
        </section>
        <hr />
      </div>
		<?php include 'footer.php'; ?>
      </footer>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script>
      $(function() {
        // Adjust intro image height based on width.
        $(window).resize(function() {
          var img = $("#tm-intro-img");
          var imgWidth = img.width();

          // 640x425 ratio
          var imgHeight = (imgWidth * 425) / 640;

          if (imgHeight < 300) {
            imgHeight = 300;
          }

          img.css("min-height", imgHeight + "px");
        });
      });
    </script>
  </body>
</html>
<?php
$memberID = $_SESSION["MemberID"];
if (isset($_POST['AddAmount-submit'])) {
    require "dbh.inc.php";
    $amount = $_POST["amount"];

    if (empty($amount)) {
        header("Location: ./FinancialStatus.php?error=emptyfields");
        exit();

    }  else {
        $sql = "INSERT INTO contributions (MemberID, Amount) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./FinancialStatus.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ii",  $memberID, $amount);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ./FinancialStatus.php?Contribution_added");
        }

    }
}
?>



