<?php session_start();
//Written By: Omar Hammoud (40002184)
if (isset($_POST['editcontract-submit'])) {
    require "dbh.inc.php";
    $cost2 = $_POST['cost'];
    $description2 = $_POST['description'];
    $conID = $_SESSION["ConID"];
    $sql ="UPDATE contract SET Cost = ?, ContractBody = ? WHERE ContractID = $conID";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./EditContract.inc.php?error=sqlerror1");
    }
    else {
        mysqli_stmt_bind_param($stmt, "is", $cost2, $description2);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }header("Location: ./Mycontract.php?Contract_Updated");
}
include "header.php";
require "dbh.inc.php";
$contractID = $_GET['ContractID1'];
$sql = "SELECT Cost, ContractBody FROM contract WHERE ContractID = ? ";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ./EditContract.inc.php?error=sqlerror1");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $contractID);
    mysqli_stmt_execute($stmt);
    $resultcheck = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($resultcheck, MYSQLI_ASSOC)) {
        $cost = $row['Cost'];
        $description = $row['ContractBody'];
        $_SESSION["ConID"] = $contractID;
    }
}
echo '<form action="EditContract.inc.php?" method="post">
 <p> Cost:</p>
 <input type="text" name="cost" placeholder="Cost" value="' . $cost . '"></br></br>
 <textarea name="description" rows="8" cols="50" style="top: 10px;" type="text" id="textPost" name="content" onkeyup="textAreaAdjust(this)">'.$description .'</textarea></br></br>
 <button class="btn btn-outline-primary m-2" type="submit" name="editcontract-submit">Post Contract</button>
</form>';
?>
