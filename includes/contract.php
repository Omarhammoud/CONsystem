<?php
/**
 * User: OmarHammoud
 */
?>
<?php include 'header.php';
require "dbh.inc.php";?>
    <main>
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
        <div class="wrapper-main" >
            <section class="section-default">
                <table class="table table-hover table-dark" >
                    <tr>
                        <th>ContractID</th>
                        <th>Name Of Client</th>
                        <th>Client Email</th>
                        <th>Address Of Client</th>
                        <th>Status</th>
                        <th>Contractor Name</th>
                        <th>Contractor Email</th>
                        <th>Contract Description</th>
                        <th>Cost</th>
                        <th>Date</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                    <?php
                    $sql = "SELECT c.ContractID, c.MemberID, c.Status ,c.Date, c.Cost, c.ContractorID, c.ContractBody, m.Name, mc.Name as contractorName, m.Address  as Address, mc.Email as contractorEmail , m.Email as clientEmail FROM contract c LEFT JOIN member m ON c.MemberID = m.MemberID LEFT JOIN member mc ON c.ContractorID = mc.MemberID ";
                    if ($conn -> connect_errno) {
                        echo "Failed to connect to MySQL: " . $conn -> connect_error;
                        exit();
                    }else {
                        $result = $conn->query($sql);

                        if($result -> num_rows > 0){
                            while ($row = $result -> fetch_assoc()){?>
                                <tr>
                                    <td> <?php echo $row["ContractID"]; ?></td>
                                    <td> <?php echo $row["Name"]; ?></td>
                                    <td> <?php echo $row["clientEmail"]; ?></td>
                                    <td> <?php echo $row["Address"]; ?></td>
                                    <td> <?php echo $row["Status"]; ?></td>
                                    <td> <?php echo $row["contractorName"]; ?></td>
                                    <td> <?php echo $row["contractorEmail"]; ?></td>
                                    <td> <?php echo $row["ContractBody"];?></td>
                                    <td> <?php echo $row["Cost"]; ?></td>
                                    <td> <?php echo $row["Date"]; ?></td>
                                    <?php if($row["Status"] == "Posted"){ ?>
                                    <td><a class="btn btn-outline-primary m-2" href="AcceptContract.inc.php?ContractID1=<?php echo $row["ContractID"];?>">Accept Contract</a></td>
                                    <?php } ?>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </table>
            </section>
        </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>