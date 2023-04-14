<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title>
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
     <!-- 
		<form action="login.php" method="post">
     	<h2>LOGINaa</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>用戶名稱</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>密碼</label>
     	<input type="password" name="password" placeholder="Password"><br>

     	<button type="submit">登入</button>
          <a href="signup.php" class="ca">創建帳號</a><br>
		  <a href="lost_post_visitors.php" class="ca">以訪客身份進入</a>
     </form> 
	-->
	 <form action="login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>電子郵件</label>
     	<input type="email" name="email" placeholder="email"><br>

		 <label>用戶名稱</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>密碼</label>
     	<input type="password" name="password" placeholder="Password"><br>

     	<button type="submit">登入</button>
          <a href="signup.php" class="ca">創建帳號</a><br>
		  <a href="lost_post_visitors.php" class="ca">以訪客身份進入</a>
     </form>
<script>
        // 監聽表單提交事件
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            // 獲取用戶輸入的電子郵件和密碼
            var email = this.email.value;
            var password = this.password.value;
			var uname = this.uname.value;
            // 登入
            firebase.auth().signInWithEmailAndPassword(email, password)
                .then(function (userCredential) {
                    var user = userCredential.user;
                    // 檢查用戶是否已驗證電子郵件
                    if (user.emailVerified) {
                        // 用戶已驗證電子郵件，可以登入
                        //alert('登入成功！');
						location.href = "login.php?uname="+uname+"&email="+email+"&password="+password;
                    } else {
                        // 用戶尚未驗證電子郵件，顯示錯誤信息
                        alert('您的帳戶尚未驗證電子郵件，請前往您的電子郵件中點擊確認鏈接以啟用帳戶。');
                        // 登出用戶
                        firebase.auth().signOut();
                    }
                })
                .catch(function (error) {
                    // 登入失敗
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    alert(errorMessage);
                });
        });
    </script> 
</body>
</html>