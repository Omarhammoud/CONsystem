<?php session_start();
// Written by: OmarHammoud(40002184)
if (isset($_POST['postcontract-submit'])) {
    require "dbh.inc.php";
    $memberID = $_SESSION["MemberID"];
    $cost = $_POST["cost"];
    $description = $_POST["contractdescription"];
    $status = "Posted";
    $date = date('Y-m-d H:i:s');

    if (empty($cost) || empty($description)) {
        header("Location: ./PostContract.php?error=emptyfields");
        exit();

    }else {
        require "dbh.inc.php";
        $sql = "INSERT INTO contract (MemberID, Cost, Status, ContractBody, Date) VALUES (?,?,?,?, ? )";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./PostContract.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "iisss",  $memberID, $cost,$status, $description, $date);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ./contract.php?Contract_Posted");
        }
    }


}
include "header.php";
?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <?php if(isset($_SESSION['MemberID'])){ ?>
                            <a class="nav-link h6" href="./contract.php">Contracts</a>
                            <a class="nav-link h6" href="./Mycontract.php">My Contracts</a>
                            <a class="nav-link h6" href="./Myjob.php">My Jobs</a>
                            <a class="nav-link h6" href="./PostContract.php" style="color: indianred""">Post Contract</a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<form action="PostContract.php" method="post">
    <input type="text" name="cost" placeholder="Enter Budget"></br></br>
   <textarea  name="contractdescription"  rows="8" cols="50" style="top: 10px;" placeholder="Insert text contract description here..." type="text" id="textPost" name="content" onkeyup="textAreaAdjust(this)"></textarea></br></br>
    <button class="btn btn-outline-primary m-2" type="submit" name="postcontract-submit">Post Contract</button>
</form>

