<?php
/*Written Miled Chalal-Henri (26685900),
*/
?>
<?php include 'header.php'; ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>financial status page</title>
  </head>
  <body>
    <div class="tm-container">
      <div class="tm-text-white tm-page-header-container">
        <h1 class="tm-page-header">financial status</h1>
      </div>
      <div class="tm-main-content">
        <div id="tm-intro-img"></div>
        <!-- Maintenance Work -->
        <section class="tm-section">
          <h2 class="tm-section-header">Maintenance Work</h2>
          <div class="tm-responsive-table">
            <table>
              <tr class="tm-tr-header">
                <th>&nbsp;</th>
                <th style="text-align-last: left;">Dates</th>
                <th style="text-align-last: left;">Contractor</th>
                <th style="text-align-last: left;">Cost</th>
              </tr>
			  <?php

    require "dbh.inc.php";
	
	$sql = "SELECT * FROM maintenance_work";
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }else {
        $result = $conn->query($sql);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		 $rationales = $row['rationales'];
		 $dates   = $row['dates'];
		 $contractor = $row['contractor'];
		 $cost = $row['cost'];
		 echo "<tr>";
         echo "<td>".$rationales."</td>";
                echo "<td style='text-align-last: left;'>".$contractor."</td>";
                echo "<td style='text-align-last: left;'>".$dates."</td>";
                echo "<td style='text-align-last: left;'>".$cost." $</td>";
         echo "</tr>";
		}
		} 
		?>
              
            </table>
          </div>
        </section>

        <!-- Special Contributions -->
        <section class="tm-section">
          <h2 class="tm-section-header">Special Contributions</h2>
          <div class="tm-responsive-table">
            <table>
              <tr class="tm-tr-header">
                <th style="text-align-last: left;">contributorName</th>
                <th style="text-align-last: left;">contribution</th>
              </tr>
			  <?php

    require "dbh.inc.php";
	
	$sql = "SELECT * FROM special_contributions";
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }else {
        $result = $conn->query($sql);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		 $contribution = $row['contribution'];
		 $contributorName   = $row['contributorName'];
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

        <!-- Financial Status -->
		<?php

    require "dbh.inc.php";
	
	$sql = "SELECT * FROM financial_status";
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }else {
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$Budget = $row['Budget'];
		$OwnershipPercent = $row['OwnershipPercent'];
		$CurrentFees = $row['CurrentFees'];
		$HistoricalRecord = $row['HistoricalRecord'];
		}	
		?>
					
        <section class="tm-section">
          <h2 class="tm-section-header">Financial Status</h2>
          <div class="tm-special-items">
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-11.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">Budget</span>
                <span class="tm-item-price"> <?php echo $Budget ?> $ </span>
              </figcaption>
            </figure>
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-12.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">Ownership Percentage</span>
                <span class="tm-item-price"> <?php echo $OwnershipPercent ?> % </span>
              </figcaption>
            </figure>
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-13.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">CurrentFees</span>
				<span class="tm-item-price"> <?php echo $CurrentFees ?> $ </span>
              </figcaption>
            </figure>
          </div>
        </section>

        <hr />
        <!-- Historical Record -->
        <section class="tm-section tm-section-small">
          <h2 class="tm-section-header">Historical Record</h2>
          <p>
            <?php echo $HistoricalRecord ?>
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




