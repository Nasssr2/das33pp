<!doctype html>
<!-- File : Lab05_3b.php -->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 05 Task 2</title>
</head>
<body>
<?php
require_once('conn.php');   # or use : include 'conn.php'
var_dump($_POST);  // show the form data sent by POST method
extract($_POST);
$sql = "UPDATE pet SET Pet_Types ='$Pet_Types',Pet_Name='$Pet_Name',Pet_Sex='$Pet_Sex',Pet_Age='$Pet_Age',Pet_weight='$Pet_weight',
    Pet_chip='$Pet_chip',Pet_Description='$Pet_Description',Pet_feature='$Pet_feature',Pet_color='$Pet_color' WHERE Pet_ID ='$Pet_ID'";
mysqli_query($conn, $sql) or die(mysqli_error($conn));

$num = mysqli_affected_rows($conn);
if ($num == 1){
    echo "<h2>A record is added successfully</h2>";

    $sql = "UPDATE lost_post SET date ='$date',time='$time',area='$area',Place='$Place',Details='$Details',coordinate='$coordinate'
    WHERE Pet_ID ='$Pet_ID' and lost_ID = '$lost_ID'";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    if ($num == 1)
        echo "<h2>A record is added successfully22222</h2>";
    else
        echo "<h2>A record is added failed2222222</h2>";
}
else
    echo "<h2>Record already exist!</h2>";

mysqli_close($conn);
//header("location:customer.php");//?msg=Record+is+successfully+updated
?>
</body>
</html>