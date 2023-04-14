<?php
session_start();
include "conn.php";
var_dump($_GET);
var_dump($_POST);

if (isset($_GET['uname']) && isset($_GET['password'])) {
    $uname = $_GET['uname'];
    $pass = $_GET['password'];
} elseif (isset($_POST['uname']) && isset($_POST['password'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['password'];
} else {
    header("Location: index.php");
    exit();
}

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$uname = validate($uname);
$pass = validate($pass);

if (empty($uname)) {
    header("Location: index.php?error=User Name is required");
    exit();
} elseif (empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
} else {
    $sql = "SELECT * FROM User WHERE User_Name='$uname' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['User_Name'] === $uname && $row['password'] === $pass) {
            $_SESSION['User_Name'] = $row['User_Name'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['User_ID'] = $row['User_ID'];
            $_SESSION['phone_Number'] = $row['phone_Number'];
            header("Location: lost_post.php");
            exit();
        } else {
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    } else {
        header("Location: index.php?error=Incorrect User name or password");
        exit();
    }
}
