<?php
/**
 * User: OmarHammoud
 **/
session_start();
require "dbh.inc.php";

$contractorID = NULL;
$contractID = $_GET["ContractID1"];
$status = "Posted";

$sql ="UPDATE contract SET ContractorID = ?, Status = ? WHERE ContractID = $contractID";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./contract.php?error=sqlerror1");
}
else {
    mysqli_stmt_bind_param($stmt, "ss",  $contractorID,$status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
header("Location: ./contract.php?Offer_Dropped");

