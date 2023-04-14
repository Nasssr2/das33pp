
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>遺失寵物互助網</title>
  <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">

  <script src="jslib/jquery-3.4.1.js"></script>
  <script type="text/javascript" src="jslib/index.js"></script>

  <script type="text/javascript"></script>
  <link rel="stylesheet" href="style2.css">
</head>

<body>
<?php 
include('header.php'); 
require_once('conn.php');
extract($_GET);
// var_dump($_GET); //!is good
// var_dump($_SESSION);

?>
<?php
//  include_once "header.php"; 

//align="center"
?>

<br></br>
  <div class="wrapper" style="border-collapse: collapse; margin:0 auto;" >

    <section class="users">
      <header>
        <div class="content">
        <?php 
            $sql = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = {$_SESSION['User_ID']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
        </div>
        <div class="details">
            <span><?php echo $row['User_Name']. " " . $row['name'] ?></span>
        </div>
      </header>
      <div class="search">
        <!-- <span class="text">Select an user to start chat</span> -->
        <input type="text" placeholder="Enter name to search..." style="display:none">
        <button style="display:none"><i class="fas fa-search" ></i></button>
      </div>
      
      <div class="users-list"  ">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
  <?php 
  //session_start();

  // var_dump($_SESSION);
  // var_dump($_POST);
  // if(!isset($_SESSION['unique_id'])){
  //   header("location: login.php");
  // }
?>



</body>
</html>
