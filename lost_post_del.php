<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 05 Task 1</title>
</head>
<body>
<?php
require_once('conn.php');   # or use : include 'conn.php'
var_dump($_GET);   // show the data passed by the query string
extract($_GET);
// Do you need to check the record exists before delete this record?
$sql = "SELECT * FROM lost_post WHERE Pet_ID ='$Pet_ID'";
$rs = mysqli_query($conn, $sql);
try{
    if (mysqli_num_rows($rs)==1){
        $sql = "DELETE FROM lost_post WHERE Pet_ID='$Pet_ID'";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
        $num = mysqli_affected_rows($conn);
        if ($num == 1){
            echo "<h2>A record is added successfully</h2>";
            $sql = "DELETE FROM pet WHERE Pet_ID='$Pet_ID'";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $num = mysqli_affected_rows($conn);
            if ($num == 1)
                echo "<h2>A record is added successfully22222</h2>";
            else
                echo "<h2>A record is added failed2222222</h2>";
        }
        else
            echo "<h2>A record is added failed</h2>";
        // use mysqli_affected_rows($conn) to check how many records are deleted
        
        header("location:my_record.php"); //?msg=Record+is+successfully+deleted
        //! header("location:my_record.php?msg=Record+is+successfully+deleted");
    } else{
        header("location:my_record.php");   # redirect browser to this page

    }
}catch (exception $e){
    header("location:my_record.php");
}
mysqli_close($conn);
// mysqli_num_rows($rs) to check how many records are found in a resultset
// use urlencode() to encode the value embedded in the 'query string'
// append a query string to pass a message to file Lab05_1a.php
?>
</body>
</html>