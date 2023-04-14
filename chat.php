<?php 
  //session_start();
  // var_dump($_SESSION);
  
  
  include_once "php2/conn.php";
//  if(!isset($_SESSION['unique_id'])){
//    header("location: login.php");
//  }
?>
<head>
  <meta charset="UTF-8">
  <title>遺失寵物互助網</title>
  <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">

  <script src="jslib/jquery-3.4.1.js"></script>
  <script type="text/javascript" src="jslib/index.js"></script>

  <script type="text/javascript"></script>
  
</head>
<?php 
// include_once "header.php"; 
include('header.php'); 
?>
<body>
  <div class="wrapper" style="border-collapse: collapse; margin:0 auto;">
  <link rel="stylesheet" href="style5.css">
    <section class="chat-area" >
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        //  var_dump($user_id);
        //var_dump($_GET['user_id']);
        //echo $user_id . '  ASFS   ';
       // echo $_GET['user_id'];
          $sql = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        
        <div class="details">
          <span><?php echo $row['User_Name']. " " . $row['name'] ?></span>
          
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="" autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
