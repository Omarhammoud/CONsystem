<html>
  </head>
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>

  <body style="background-color:#ddebe9">
    <div class="container" style="height: 20em; width: 40em">

        <form action="processLogin.php" class="form-signin form-horizontal" method="post">
            <br><br>
            <h2 class="form-signin-heading">Welcome to CON </h2>
			<br>
			<h3>Condo-association Online Network System</h3>
			<br><br> 
			<h2 class="form-signin-heading"> Please sign in </h2>
            <br>
            <label for="inputMemberID" class="sr-only">Member ID</label>
            <input  name="memberID" id="inputMemberID" class="form-control" placeholder="memberID" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password"  class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-outline-light btn-block" type="submit" name="login-submit" value="Login" style="background-color:#D49DB1;">Sign in</button>
        </form>

    </div>
  </body>
</html>
