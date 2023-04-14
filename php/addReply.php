<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

  if (isset($_POST['replyTextArea'])) {
    echo "yes";
  }
  if (isset($_GET['Pet_ID'])) {
      echo "yes<br>";
    echo $_GET['Pet_ID'];
    extract($_GET);
    echo "Pet id".$Pet_ID;
    echo "<br>";
    echo "receive person ".$receive_person;    
    echo "<br>";
    echo "send person: ".$Send_person;
    echo "<br>";
    echo "LOST POST ID: ".$lost_ID;    
    echo "<br>";
    $txt = $_POST['replyTextArea'];
    echo "textContent: ".$txt;
    //var_dump($_GET['Pet_ID']);
    
  date_default_timezone_set('Asia/Hong_Kong');
  echo  date('d-m-y h:i:sa');
  $date = date('d-m-y h:i:sa');
  $conn = new mysqli("127.0.0.1", "root", "", "testdb");
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }else echo "<br>connect db";

    
    
if(isset($_POST["replyTextArea"])){
  $mail = new PHPMailer(true);
  // Settings
  $mail->IsSMTP();
  $mail->Host= "smtp.gmail.com"; // SMTP server example
  $mail->SMTPAuth = true; // enable SMTP authentication
  $mail->Username = "tonyhe112Email@gmail.com";            // SMTP account username example
  $mail->Password   = "lllncumjhvwmxedf"; // SMTP account password example
  $mail->SMTPSecure = 'ssl'; 
  $mail->CharSet="UTF-8";
  $mail->Port = 465; // set the SMTP port for the GMAIL server
  
  
  $sql = "SELECT * FROM pet WHERE Pet_ID = '$petId'";
  $rs = mysqli_query($conn, $sql) or die ('<div class = "error"> SQL command fails : <br> ' . mysqli_error($conn) . " </div> ");// $ rs is the result set
  $rec = mysqli_fetch_assoc($rs);
  extract($rec);
  
 $mail->AddEmbeddedImage('../image/'.$Pet_image, 'photo');
  // Content
  $mail->setFrom('tonyhe112Email@gmail.com');  
  $mail->addAddress($email);
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = '遺失寵物互助網-'.$Pet_Name.'的帖文有一則留言';
  $mail->Body = '你發佈有關遺失寵物 <b>'.$Pet_Name.'</b> 的貼文有一則新留言<br><br>留言訊息:<br><div style="white-space: pre-line;">'.$txt.'</div>';

  $mail->send();
  echo "ok";
}
    
    
    
    

    

  $sql = "INSERT INTO `reply` (`textContent`, `reply_status`, `reply_dateTime`, `Send_person`,`send_person_name`, `receive_person`, `post_id`) VALUES ('$txt', '1', '$date','$Send_person','$Send_person_Name','$receive_person','$lost_ID');";

    
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  }
  header("location:../lost_post_view.php?Pet_ID=$Pet_ID");
?>