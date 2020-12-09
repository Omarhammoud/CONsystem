<?php
   //Written By: Omar Hammoud (40002184)
 include './header.php';
?>


<main>
    <div class="wrapper-main" >
        <section class="section-default">
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
                             <td> <?php
                                 if($row["Status"]== "active"){
                                     echo $row["Status"];
                                 }else{
                                     echo "<p style=\"display: inline-block; border: 2px; border-style:solid; border-color:#FF0000; padding: 1em;\">".$row["Status"]."</p>";
                                 }
                                  ?></td>
                             <td> <?php echo $row["Privilege"]; ?></td>
                             <td><a href="UserEdit.inc.php?MemberID1=<?php echo $row["MemberID"];?>">Edit</a></td>
                             <td><a href="UserDelete.inc.php?MemberID2=<?php echo $row["MemberID"];?>">Delete</a></td>
                             <td><a href="resetPassword.php?MemberID2=<?php echo $row["MemberID"];?>">Reset Password</a></td>

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
