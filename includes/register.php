<?php
// Written by: OmarHammoud(40002184)
include "header.php";
?>
<h1>Sign up as a member</h1>
<form action="signup.inc.php" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="email" placeholder="Email">
    <input type="text" name="address" placeholder="Address">
    <input type="password" name="pwd" placeholder="Password">
    <input type="password" name="pwd-second" placeholder="Type Password Again">
    <button type="submit" name="signup-submit">Sign Up</button>
</form>
<h1>Sign up as a contractor</h1>
<form action="signup.inc.php" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="pwd" placeholder="Password">
    <input type="password" name="pwd-second" placeholder="Type Password Again">
    <button type="submit" name="contractorsignup-submit">Sign Up</button>
</form>



