<?php
   //Written By: Omar Hammoud (40002184)
    
?>

<?php include './header.php';
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Create new member</h1>
            <form action="signup.inc.php" method="post">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="address" placeholder="Address">
                <input type="text" name="status" placeholder="Status">
                <input type="text" name="privilege" placeholder="Privilege">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-second" placeholder="Type Password Again">
                <button type="submit" name="signup-submit">Sign Up</button>
            </form>

            <h2>List of Members:</h2>
            <table class = "table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Privilege</th>
                </tr>
                <?php
                require "dbh.inc.php";

                $sql ="SELECT MemberID, Name, Email, Address, Status, Privilege FROM member";
                if ($conn -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $conn -> connect_error;
                    exit();
                }else {
                    $result = $conn->query($sql);

                    if($result -> num_rows > 0){
                        while ($row = $result -> fetch_assoc()){ ?>
                         <tr>
                             <td> <?php echo $row["MemberID"]; ?></td>
                             <td> <?php echo $row["Name"]; ?></td>
                             <td> <?php echo $row["Email"]; ?></td>
                             <td> <?php echo $row["Address"]; ?></td>
                             <td> <?php echo $row["Status"]; ?></td>
                             <td> <?php echo $row["Privilege"]; ?></td>
                             <td><a href="UserEdit.inc.php?MemberID1=<?php echo $row["MemberID"];?>">Edit</a></td>
                             <td><a href="UserDelete.inc.php?MemberID2=<?php echo $row["MemberID"];?>">Delete</a></td>


                         </tr>
                        <?php
                        }
                    }

                }



                ?>
            </table>
        </section>
    </div>
</main>



<?php include './footer.php'; ?>

</section>
</div>
</main>


<?php include './footer.php'; ?>
