<?php include 'header.php'; ?>

<?php include_once '../config/init.php'; ?>
<main>
    <?php
    if(isset($_SESSION['email'])){
    echo " <p>Logged in</p>";
    }
    else{
        echo " <p>Logged out</p>";
    }
    ?>

</main>

<?php include 'footer.php'; ?>
