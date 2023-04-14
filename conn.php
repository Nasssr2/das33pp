<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "testdb";  //! need change
$conn = mysqli_connect($hostname, $username, $password, $database) or die(mysqli_connect_error());
?>