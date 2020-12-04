<?php include "./header.php"?>
<?php 
//Written By: Israt Noor Kazi (40029299)
if(isset($_SESSION['MemberID'])){

        $sql = "SELECT * FROM `part_of` GROUP BY 'GroupID' ";
        $result = $conn->query($msql);

        if ($result->num_rows > 0){
            while ($row = $result.fetch_assoc()){
                echo "Member ID: ". $row["MemberID"]. " - Group ID: ". $row["GroupID"]. "<br>";
            }
        }
        else{
            echo "No Results."
        }

 } ?>

<?php 
    include "./footer.php"
?>
