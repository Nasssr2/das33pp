<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>遺失寵物互助網</title>
  <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/index_mobile.css" media="screen and (max-width: 768px)">
  <script src="jslib/jquery-3.4.1.js"></script>
  <script type="text/javascript" src="jslib/index.js"></script>
  <script type="text/javascript">
  </script>
</head>

<body>
<?php 
include('header.php'); 
// var_dump($_GET); //!is good
// var_dump($_SESSION);
?>




  <div id="searchResult">
    <div id="searchResultTittle">
      <b>人員控制</b>
    </div>
    <table border="1" style="border-collapse: collapse; margin:0 auto;">
    <tr>
            <th>User_ID</th>
            <th></th>
            <th>User_Name</th>
            <th></th>
            <th>phone_Number</th>
            <th></th>
            <th>name</th>
            <th></th>
            <th>user_Email</th>
        </tr>
    <?php
      require_once('conn.php');   # or use : include 'conn.php';
      $sql = "SELECT * FROM user"; //! need change
      

        //$sql = "SELECT Pet_image, Pet_Types, pet.Pet_Name, area, Place, time, date, lost_post.Pet_ID FROM lost_post, pet WHERE lost_post.Pet_ID=pet.Pet_ID"; //! need change



      $rs = mysqli_query($conn, $sql);
      
      while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);  // create new variables $custID, $custName, $custPswd, $custGender
        //var_dump($rc);
        // heredoc can simplify the syntax to output HTML code embedded with PHP variables
echo <<<EOD
<tr>
<td>$User_ID</td>
<td></td>
<td>$User_Name</td>
<td></td>
<td>$phone_Number</td>
<td></td>
<td>$name</td>
<td></td>
<td>$user_Email</td>

<td> <input type="button" class="button1" onclick="window.location.href='list_user_edit.php?User_ID=$User_ID'" value="edit"></td>
<td> <input type="button" class="button1" onclick="window.location.href='list_user_del.php?User_ID=$User_ID'" value="delete"></td>
</tr>

EOD;
      }
      mysqli_free_result($rs);
      mysqli_close($conn);
    ?>
    <!-- </table> -->

  </div>
</body>
</html>