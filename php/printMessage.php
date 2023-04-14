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

$s='<span class="messageTypeLabel">新的通知</span>';

$sql = "SELECT * FROM reply,lost_post,pet WHERE post_id = lost_post.lost_ID AND lost_post.Pet_ID = pet.Pet_ID AND reply_status=1 AND receive_person='$id' ORDER by reply_id DESC";
$result = $conn->query($sql);
//$message = mysql_fetch_assoc($result); //expecting just on row

while ($rc = mysqli_fetch_assoc($result)) {
  extract($rc);
  $s = $s.'<a href="lost_post_view.php?Pet_ID='.$Pet_ID.'">
  <div class="message" style="color:black;text-align:left">
    <div class="messagePetPhoto">
    <img src="image/'.$Pet_image.'">
    </div>
    <div style="color:black;text-align:left">
      <b class="sendPerson">'.$send_person_name.'&nbsp<b>在&nbsp'.$Pet_Name.'&nbsp的貼文發表了一則留言
      <br><span class="sendDayTime">'.$reply_dateTime.'</span>
    </div>
  </div></a><br>';
}

$s = $s .'<br><span class="messageTypeLabel">之前的通知</span><br>';

$sql = "SELECT * FROM reply,lost_post,pet WHERE post_id = lost_post.lost_ID AND lost_post.Pet_ID = pet.Pet_ID AND reply_status=2 AND receive_person='$id' ORDER by reply_id DESC";
$result = $conn->query($sql);
while ($rc = mysqli_fetch_assoc($result)) {
  extract($rc);
  $s = $s.'<a href="lost_post_view.php?Pet_ID='.$Pet_ID.'">
  <div class="message" style="color:black;text-align:left">
    <div class="messagePetPhoto">
    <img src="image/'.$Pet_image.'">
    </div>
    <div style="color:black;text-align:left">
      <b class="sendPerson">'.$send_person_name.'&nbsp<b>在&nbsp'.$Pet_Name.'&nbsp的貼文發表了一則留言
      <br><span class="sendDayTime">'.$reply_dateTime.'</span>
    </div>
  </div></a><br>';
}


echo $s;

//$sql = "UPDATE reply SET reply_status = 2 WHERE reply_status=1 AND receive_person='$id'";
//$conn->query($sql);

//echo json_encode( $json );


$conn->close();
?>