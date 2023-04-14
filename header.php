<?php
session_start();
if (isset($_SESSION['User_ID'])&& isset($_SESSION['User_Name'])) {
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="jslib/header.js"></script>
  <script type="text/javascript">
    function bellDisplay() {
      if(document.getElementById("messageBox").style.display=="block"){
        document.getElementById("messageBox").style.display="none";
      }else{
        document.getElementById("messageBox").style.display="block";
      }
      document.getElementById("noti_number").textContent=0;
      
    }
  </script>
  <script type="text/javascript">
  var snd = new Audio("short.mp3");
  function  printMessage(){
    var id = <?php echo $_SESSION['User_ID']?>;
    $.ajax({
        url: "php/printMessage.php",
        method: "GET",
        data: {
            id: id
        },success: function(data){
          $('#newMessage').html(data);
        }
    }).done(function() {
        //Once it is done
        //console.log("OK!");
    });
  }
  printMessage();
  function loadDoc() {
  setInterval(function(){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("noti_number").innerHTML = this.responseText;
      //if(this.responseText>parseInt(document.getElementById("noti_number").textContent)&&this.responseText!=0){
      if(this.responseText>0&&this.responseText!=0&&this.responseText>document.getElementById("noti_number").textContent){
        document.getElementById("noti_number").innerHTML = parseInt(document.getElementById("noti_number").textContent)+parseInt(this.responseText);
        document.getElementById("noti_number").innerHTML = parseInt(this.responseText);
        snd.play();
        
        // Call showNotification when a new message is detected
        Android.showNotification("New Message", "You have a new message");

        printMessage();
        
      }

    }
   };
   xhttp.open("GET", "php/data.php?ID=<?php echo $_SESSION['User_ID']?>", true);
   xhttp.send();
  },1000);
 }
 loadDoc();

 // ...
</script>
  
<div id="siteNave">
    <div id="siteNaveBd">
      <div class="siteNaveBdBtn" onclick="location.href='lost_post.php';">主頁</div>
      <div class="siteNaveBdBtn" onclick="location.href='lost_post.php';">遺失寵物</div>
      <div class="siteNaveBdBtn" onclick="location.href='get_post.php';">拾獲寵物</div>
      <div class="siteNaveBdBtn" onclick="location.href='my_record.php';">我的紀錄</div>
      <!-- <div class="siteNaveBdBtn" onclick="location.href='';">註冊</div> -->
      <div class="siteNaveBdBtn" style="margin-left: 25px;" onclick="location.href='post.php';">發佈遺失/拾獲貼文</div>
      <div class="siteNaveBdBtn" onclick="location.href='users.php';">我的通話紀錄</div>
      <div class="siteNaveBdBtn" onclick="location.href='list_user.php';">人員控制</div>
      <div class="right"><a href="logout.php">登出</a></div>
      <div class="right">歡迎, <?php echo $_SESSION['name']; ?></div>
      <div class="right bell">
        <img src="web_image/bell.png" class="button-on-click" alt="" onclick="bellDisplay();">
        <div id="noti_number" class="bellMessage button-on-click" onclick="bellDisplay();" style="display:none;">0</div>
        <div id="messageBox" style="text-align: left;display: none;">
          <div style="font-size:18px;margin-left:5px;" class="messageBigLabelDiv">
            <label class="messageBigLabel">通知</label>
          </div><br>
          <span id="newMessage" style="text-align:left">
            <div class="message">在的貼文發表了一則留言</div>
            <div class="message">在的貼文發表了一則留言</div>
          </span>
          <br>
        </div>
      </div>
    </div>
  </div>

<?php
}else{
  header("Location: index.php");
  exit();
}
?>
<script type="text/javascript">
  var snd = new Audio("short.mp3");
  function  printMessage(){
    var id = <?php echo $_SESSION['User_ID']?>;
    $.ajax({
        url: "php/printMessage.php",
        method: "GET",
        data: {
            id: id
        },success: function(data){
          $('#newMessage').html(data);
        }
    }).done(function() {
        //Once it is done
        //console.log("OK!");
    });
  }
  printMessage();
  function loadDoc() {
  setInterval(function(){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("noti_number").innerHTML = this.responseText;
      //if(this.responseText>parseInt(document.getElementById("noti_number").textContent)&&this.responseText!=0){
      if(this.responseText>0&&this.responseText!=0&&this.responseText>document.getElementById("noti_number").textContent){
        document.getElementById("noti_number").innerHTML = parseInt(document.getElementById("noti_number").textContent)+parseInt(this.responseText);
        document.getElementById("noti_number").innerHTML = parseInt(this.responseText);
        snd.play();
        
        printMessage();
        
      }

    }
   };
   xhttp.open("GET", "php/data.php?ID=<?php echo $_SESSION['User_ID']?>", true);
   xhttp.send();
  },1000);
 }
 loadDoc();
  

  $(function() {
    //On click on this kind of button
    $(".button-on-click").on('click', function() {
      if(document.getElementById("messageBox").style.display=="block"){
        //alert("yes");
        var id = <?php echo $_SESSION['User_ID']?>;
        //Send AJAX request on page youraction.php?id=X where X is data-id attribute's value
        //the ID used in mysql query
        $.ajax({
            url: "php/update.php",
            method: "GET",
            data: {
                id: id
            },success: function(data){
              //printMessage();
            }
        }).done(function() {
        });
      }//else alert("no");
    });
  });  
  
</script>