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
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Contractor</th>
                <th>&nbsp;&nbsp;&nbsp;Cost&nbsp;&nbsp;&nbsp;</th>
              </tr>
			  <?php

    require "dbh.inc.php";
	
	$sql = "SELECT * FROM contract WHERE Status='Completed'";
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }else {
        $result = $conn->query($sql);
		 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		 $rationales = $row['ContractBody'];
		 $dates   = $row['Date'];
		 $contractor = $row['MemberID'];
		 $cost = $row['Cost'];
		 
		 $sql = "SELECT Name FROM member WHERE MemberID=$contractor";
		 $final_result = $conn->query($sql);
		 $val = $final_result->fetch_assoc();
		 $contractor = $val['Name'];
		 echo "<tr>";
				echo "<td class='tm-text-left'>".$rationales."</td>";
				echo "<td>".$dates."</td>";
                echo "<td>".$contractor."</td>";
                echo "<td>".$cost." $</td>";
         echo "</tr>";
		}
		} 
		?>
              
            </table>
          </div>
        </section>

        <!-- Financial Status -->	
        <section class="tm-section">
          <h2 class="tm-section-header">Financial Status</h2>
          <div class="tm-special-items">
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-11.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">Budget</span>
                <span class="tm-item-price"> 35 0000 $ </span>
              </figcaption>
            </figure>
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-12.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">Ownership Percentage</span>
                <span class="tm-item-price"> 20% </span>
              </figcaption>
            </figure>
            <figure class="tm-special-item">
              <img src="img/chilling-cafe-13.jpg" alt="Image" class="tm-special-item-img" />
              <figcaption>
                <span class="tm-item-name">CurrentFees</span>
				<span class="tm-item-price"> 12000 $ </span>
              </figcaption>
            </figure>
          </div>
        </section>

        <hr />
        <!-- Historical Record -->
        <section class="tm-section tm-section-small">
          <h2 class="tm-section-header">
			Historical Record
		  </h2>
          <p>
		  INSERT HISTORIAL RECORD HERE Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget tincidunt lectus. 
		  Ut interdum eleifend mattis. Duis lorem ex, dictum sed malesuada vitae, vestibulum et neque. 
		  Suspendisse mollis tortor nec dolor blandit, et sagittis mi pretium.
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




