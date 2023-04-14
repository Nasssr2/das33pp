<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = new mysqli($servername, $username, $password, $dbname);
if (empty($_GET['id'])) {
    exit();
}
$id = (int)$_GET['id'];


$sql = "UPDATE reply SET reply_status = 2 WHERE reply_status=1 AND receive_person='$id'";
$conn->query($sql);



$conn->close();
?>