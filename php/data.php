<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
extract($_GET);
$sql = "SELECT * FROM reply WHERE reply_status=1 AND receive_person='$ID'";
$result = $conn->query($sql);

echo $result->num_rows;

//$sql = "UPDATE reply SET reply_status = 2 WHERE reply_status=1 AND receive_person='$ID'";
//$conn->query($sql);



$conn->close();
?>