<?php include './header.php'; ?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Create new member</h1>
            <form action="signup.inc.php" method="post">
                <input type="text" name="memberid" placeholder="Member ID">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="address" placeholder="Address">
                <input type="text" name="status" placeholder="Status">
                <input type="text" name="privilege" placeholder="Privilege">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-second" placeholder="Type Password Again">
                <button type="submit" name="signup-submit">Sign Up</button>
            </form>

        </section>
    </div>
</main>


<?php include './footer.php'; ?>
