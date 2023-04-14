<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lab 05 Task 1</title>
</head>
<body>
<?php
require_once('conn.php');   # or use : include 'conn.php'

extract($_GET);
var_dump($_GET);   
$sql = "SELECT  lost_ID FROM  get_post  WHERE User_ID='$User_ID'";
$rs = mysqli_query($conn , $sql);
while ($rc = mysqli_fetch_assoc ($rs)){
    extract ($rc);
    var_dump($rc);
    $sql = "DELETE FROM get_post WHERE lost_ID ='$lost_ID'";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // use mysqli_affected_rows($conn) to check how many records are deleted
}

$sql = "SELECT  lost_ID FROM  lost_post  WHERE User_ID='$User_ID'";
$rs = mysqli_query($conn , $sql);
while ($rc = mysqli_fetch_assoc ($rs)){
    extract ($rc);
    var_dump($rc);
    $sql = "DELETE FROM lost_post WHERE lost_ID ='$lost_ID'";
    //$sd  = "DELETE FROM `lost_post` WHERE `lost_ID` = 4"
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // use mysqli_affected_rows($conn) to check how many records are deleted
}

try{
    $sql = "DELETE FROM user WHERE User_ID='$User_ID'";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
    mysqli_close($conn);
    header("location:list_user.php?msg=Record+is+successfully+deleted"); //?msg=Record+is+successfully+deleted

}catch (exception $e){
    header("location:bad.php");
}

?>
</body>
</html>