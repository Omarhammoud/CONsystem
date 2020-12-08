<?php
//Written By:  Omar Hammoud (40002184)
session_start();
session_unset();
session_destroy();
header("Location: ./index.php")
?>