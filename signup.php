<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/style_mobile.css" media="screen and (max-width: 768px)">
     <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-auth.js"></script>
    <script>
        // 將你的 Firebase 項目配置添加到這裡
        var firebaseConfig = {
            apiKey: "AIzaSyCf9_Y3os6G0Cy7jau0U4Nm6UyFV7Y0zrk",
            authDomain: "email-verification-b0dd4.firebaseapp.com",
            projectId: "email-verification-b0dd4",
            storageBucket: "email-verification-b0dd4.appspot.com",
            messagingSenderId: "922609989682",
            appId: "1:922609989682:web:6ec3d8d10d512b7d76e42b",
            measurementId: "G-KD2JNJJV7Z"
        };
        // 初始化 Firebase
        firebase.initializeApp(firebaseConfig);
    </script>
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>驗證郵件</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <!-- <label>你的姓名</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"><br>
          <?php }?>

          <label>用戶名稱</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"><br>
          <?php }?>


          <label>phone_Number</label>
          <?php if (isset($_GET['phone_Number'])) { ?>
               <input type="INTEGER" 
                      name="phone_Number" 
                      placeholder="User Name"
                      value="<?php echo $_GET['phone_Number']; ?>"><br>
          <?php }else{ ?>
               <input type="INTEGER" 
                      name="phone_Number" 
                      placeholder="User Name"><br>
          <?php }?> -->

          
          <label>電子郵件</label>
     	<input type="email" 
                 name="user_Email" 
                 placeholder="email"><br>

     	<label>密碼</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"><br>

          <label>再次輸入密碼</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Re_Password"><br>

   
     	<button type="submit">傳送電子郵件</button>
          <a href="index.php" class="ca">已經擁有了帳號?</a>
     </form>
     <script>
        // 監聽表單提交事件
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            // 獲取用戶輸入的電子郵件和密碼
            var user_Email = this.user_Email.value;
            var password = this.password.value;
            // 註冊新用戶
            firebase.auth().createUserWithEmailAndPassword(user_Email, password)
                .then(function (userCredential) {
                    // 註冊成功，Firebase 會自動向用戶發送確認電子郵件
                    var user = userCredential.user;
                    sendVerificationEmail();
                    alert('註冊成功！請到您的電子郵件中點擊確認鏈接以啟用帳戶。');
                    location.href = "signup2.php?a="+user_Email+"&ab="+password;
                })
                .catch(function (error) {
                    // 註冊失敗
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    alert(errorMessage);
                });
        });

        // 傳送確認電子郵件
        function sendVerificationEmail() {
            var user = firebase.auth().currentUser;
            user.sendEmailVerification()
                .then(function () {
                    // 電子郵件已成功發送
                    console.log('Verification email sent.');
                })
                .catch(function (error) {
                    // 電子郵件發送失敗
                    console.error('Error sending verification email:', error);
                });
        }
    </script>
</body>
</html>