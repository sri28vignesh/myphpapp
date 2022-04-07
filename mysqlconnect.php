<?php
echo '<h4> Welcome!, This site is up and running. </h4>';
$dbhost = 'sri-db-instance.cq174vfsoqja.us-east-1.rds.amazonaws.com';
$dbname = 'srimysqldb';
$username = 'sri';
$password = 'sridbpass';

$conn = new mysqli($dbhost, $username, $password, $dbname);
if($conn->connect_error) {
                die('Could not connect: ' . $conn->connect_error);
}
echo '--------- MySQL Connected successfully -------<br>';

echo 'List of Persons <br>';
$sql = "SELECT * FROM persons";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
          // output data of each row
           while($row = $result->fetch_assoc()) {
               echo "id: " . $row["personid"]. " - Name: " . $row["name"]. " " . $row["city"]. "<br>";
                 }
            } else {
                   echo "0 results";
                   }
$conn->close();
?>