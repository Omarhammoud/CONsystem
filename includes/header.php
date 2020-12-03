<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CONsystem</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand h6" href="./MemberDashboard.php">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <?php if(isset($_SESSION['MemberID'])&&isset($_SESSION['isAdmin'])){ ?>
                            <?php if($_SESSION['isAdmin']){?>
                            <a class="nav-link h6" href="./signup.php">Sign Up</a>
                            <?php } ?>
                            <a class="nav-link h6" href="./NewPost.html">Post</a>
                            <a class="nav-link h6" href="./GroupPage.php">Group</a>
                            <a class="nav-link h6" href="./EmailPage.php">Email</a>
                        <?php } ?>    
                    </div>

                    <div class="navbar-nav ml-auto">
                        <?php if(isset($_SESSION['MemberID'])&&isset($_SESSION['isAdmin'])){ ?>
                            <a class="nav-link h6" href="#">Signed In As <?php echo $_SESSION['Name'] ;?></a>
                            <a class="btn btn-outline-danger d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="./logout.inc.php">Logout</a>
                        <?php }else{ ?>
                            <a class="nav-link h6" href="./LoginPage.php">Login</a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </nav>
    </header>