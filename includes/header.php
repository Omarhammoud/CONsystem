<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Written By: Israt Noor Kazi (40029299),
// Omar Hammoud (40002184)
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CONsystem</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet" />
    <link href="all.min.css" rel="stylesheet" />
    <link href="tooplate-chilling-cafe.css" rel="stylesheet" />
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="./MemberDashboard.php"><span>☴</span> ConSys</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php if(isset($_SESSION['MemberID'])){ ?>
                        <a class="nav-link" href="./contract.php">Contracts</a>
                        <?php if(($_SESSION['isMember']) || ($_SESSION['isAdmin'])){ ?>
                            <?php if($_SESSION['isAdmin']){?>
                                <a class="nav-link" href="./signup.php">Manage Accounts</a>
                            <?php } ?>
                            <a class="nav-link" href="./NewPost.php">Post</a>
                            <a class="nav-link" href="./GroupPage.php">Group</a>
                            <a class="nav-link" href="./FinancialStatus.php">Finance</a>
                            <a class="nav-link" href="./EmailPage.php">Email</a>
                        <?php } } ?>
                </div>
                <div class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION['MemberID'])&&isset($_SESSION['isAdmin'])){ ?>
                        <a class="nav-link h6" href="#">Signed In As <?php echo $_SESSION['Name'] ;?></a>
                        <a class="btn btn-outline-danger mb-3 mb-md-0 ml-md-3" href="./logout.inc.php">Logout</a>
                    <?php }else{ ?>
                        <a class="nav-link h6" href="./LoginPage.php">Login</a>
                        <a class="nav-link h6" href="./register.php">Sign up</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</header>