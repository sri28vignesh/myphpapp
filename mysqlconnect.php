<?php
echo '<h4> Welcome!, This site is up and running. </h4>';
$dbhost = db_host;
$dbname = 'srimysqldb';
$username = mysql_user;
$password = mysql_password;

$conn = new mysqli($dbhost, $username, $password, $dbname);
if($conn->connect_error) {
                die('Could not connect: ' . $conn->connect_error);
}
echo '--------- MySQL Connected successfully -------<br>';

$sql1 = "CREATE TABLE IF NOT EXISTS persons( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), city VARCHAR(50));";
if ($conn->query($sql1) === TRUE) {
          echo "\nTable Persons created successfully";
              
              $sql = "insert into persons (name,city) values ('Adam','Coimbatore');";
              $sql .= "insert into persons (name,city) values ('Brevis','Chennai');";
              $sql .= "insert into persons (name,city) values ('Milne','Bangalore');";
              if ($conn->multi_query($sql) === TRUE) {
              echo "New records created successfully";
              } 
                  else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }

} else {
          echo "Error creating table: " . $conn->error;
}

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
