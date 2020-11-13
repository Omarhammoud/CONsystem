<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CONsystem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav>
        <a href="./index.php"> ConSystem</a>
            <div>
                <?php
                if(isset($_SESSION['MemberID'])){
                   echo "  <a href=\"./isadmin.inc.php\">Create User</a>
                        <form action=\"./logout.inc.php\" method=\"post\">
                    <button type=\"submit\" name=\"logout-submit\">Logout</button>
                </form>";
                }
                else{
                   echo "<form action=\"./login.inc.php\" method=\"post\">
                    <input type=\"text\" name=\"memberid\" placeholder=\"Username\">
                    <input type=\"password\" name=\"pwd\" placeholder=\"Password\">
                    <button type=\"submit\" name=\"login-submit\">Login</button>
                </form>";
                }
                ?>



            </div>
        </nav>
    </header>