<?php
error_reporting(0);
ob_start();
session_start();
// var_dump($_SESSION);
// var_dump($_POST);
//var_dump(session_id());
//var_dump(session_name());

require_once('conn.php');
$sql='SELECT IFNULL(max(lost_ID), 0)+1 AS "lost_ID" ,IFNULL(max(pet.Pet_ID), 0)+1 AS "Pet_ID" FROM lost_post, pet;';
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>遺失寵物互助網</title>
  <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/index_mobile.css" media="screen and (max-width: 768px)">
  <link rel="stylesheet" href="css/post.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/post_mobile.css">
  <link rel="stylesheet" href="css/inputLabel.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/inputLabel_mobile.css">
  <script type="text/javascript" src="jslib/jquery-3.4.1.js"></script>
  <script type="text/javascript" src="jslib/post.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
<!--AI-->
  <script type="text/javascript">
    const URL = "tm-my-image-model/";

    let model, webcam, labelContainer, maxPredictions;
    var bugPredit = 0;
    async function init(event) {
      const modelURL = URL + "model.json";
      const metadataURL = URL + "metadata.json";

      model = await tmImage.load(modelURL, metadataURL);
      maxPredictions = model.getTotalClasses();

      window.requestAnimationFrame(loop);
      labelContainer = document.getElementById("label-container");
      /*for (let i = 0; i < maxPredictions; i++) {
        labelContainer.appendChild(document.createElement("div"));
      }*/

      if (event.target && event.target.files) {
        document.getElementById("uploadPreview").src = window.URL.createObjectURL(event.target.files[0]);
      }
    }

    async function loop(event) {
      await predict(event);
    }
    async function predict(event) {
      const prediction = await model.predict(document.getElementById("uploadPreview"));
      var similar = 0;
      var similarName = "";
      for (let i = 0; i < maxPredictions; i++) {
        const classPrediction = prediction[i].className + ": " + prediction[i].probability.toFixed(2);
        //labelContainer.childNodes[i].innerHTML = classPrediction;
        if (prediction[i].probability.toFixed(2) > similar) {
          similar = parseFloat(prediction[i].probability.toFixed(2));
          similarName = prediction[i].className;
        }
      }
      if (bugPredit < 10) {
        bugPredit++;
        init(event);
      } else {

        switch (similarName) {
          case "其他": {
            document.getElementById("inputVariety_other").checked = true;
            break;
          }
          case "布偶貓":
          case "伯曼貓":
          case "波斯貓":
          case "英國短毛貓":
          case "混種短毛貓":
          case "斯芬克斯貓":
          case "摺耳貓": {
            document.getElementById("inputVariety_cat").checked = true;
            document.getElementById("petVariety").value = similarName;
            break;
          }
          default: {
            document.getElementById("inputVariety_dog").checked = true;
            document.getElementById("petVariety").value = similarName;
          }
        }

        if (document.getElementById("uploadPreview").naturalHeight > document.getElementById("uploadPreview").naturalWidth) {
          document.getElementById("uploadPreview").style.width = "100%";
          document.getElementById("uploadPreview").style.height = "auto";
        }
        if (document.getElementById("uploadPreview").naturalHeight < document.getElementById("uploadPreview").naturalWidth) {
          document.getElementById("uploadPreview").style.width = "auto";
          document.getElementById("uploadPreview").style.height = "100%";
        }
        bugPredit = 0;
        init2(event);
      }
    }
  </script>
<!--AI2-->
  <script type="text/javascript">
    const URL2 = "tm-my-image-model/color/";

    let model2, labelContainer2, maxPredictions2;
    var bugPredit2 = 0;
    async function init2(event) {
      const modelURL2 = URL2 + "model.json";
      const metadataURL2 = URL2 + "metadata.json";

      model2 = await tmImage.load(modelURL2, metadataURL2);
      maxPredictions2 = model2.getTotalClasses();

      window.requestAnimationFrame(loop2);
      labelContainer2 = document.getElementById("label-container");


      if (event.target && event.target.files) {
        document.getElementById("uploadPreview").src = window.URL.createObjectURL(event.target.files[0]);
      }
    }

    async function loop2(event) {
      await predict2(event);
    }
    async function predict2(event) {
      const prediction2 = await model2.predict(document.getElementById("uploadPreview"));
      var similar2 = 0;
      var similarName2 = "";
      for (let i = 0; i < maxPredictions2; i++) {
        const classPrediction = prediction2[i].className + ": " + prediction2[i].probability.toFixed(2);
        if (prediction2[i].probability.toFixed(2) > similar2) {
          similar2 = parseFloat(prediction2[i].probability.toFixed(2));
          similarName2 = prediction2[i].className;
        }
      }
      if (bugPredit2 < 10) {
        bugPredit2++;
        init2(event);
      } else {
            document.getElementById("petColor").value = similarName2;
        bugPredit2 = 0;
      }
    }
  </script>
  <!--OTHER-->
  
  <script type="text/javascript">
    $.showPage = function(val) {
      $("#InputFormP" + val).show(750);
      $("#postState_" + val).css("color", "blue");
      $("#postState_" + val + " div").css("border-color", "blue");
    };
    $.closePageState = function() {
      for (let i = 1; i <= 3; i++) {
        $("#InputFormP" + i).hide(750);
        $("#postState_" + i).css("color", "grey");
        $("#postState_" + i + " div").css("border-color", "grey");
      }
    };
    $.showMap = function() {
      for (let i = 1; i <= 3; i++) {
        $("#uploadPhotoDiv").hide(750);
        $("#mapIframe").show(750);
      }
    };
    $.showPhoto = function() {
      for (let i = 1; i <= 3; i++) {
        $("#mapIframe").hide(750);
        $("#uploadPhotoDiv").show(750);
      }
    };
    //mapIframe
    //uploadPhotoDiv
    var Page = 1;

    function changePage(val) {
      Page += val;
      switch (Page) {
        case 1: {
          document.getElementById('lastPage').style.display = "none";
          document.getElementById('NextPage').style.display = "block";
          $.closePageState();
          $.showPage(1);
          $.showPhoto();
          break;
        }
        case 2: {
          document.getElementById('lastPage').style.display = "block";
          document.getElementById('NextPage').style.display = "block";
          $.closePageState();
          $.showPage(2);
          $.showMap();
          break;

        }
        case 3: {
          document.getElementById('NextPage').style.display = "none";
          document.getElementById('lastPage').style.display = "block";
          $.closePageState();
          $.showPage(3);
          break;

        }
      }
    }

    function jingPianDisplay(display) {
      if (display) document.getElementById("form_inputChip_div").style.display = "inline-block";
      else document.getElementById("form_inputChip_div").style.display = "none";
    }

    function juimpPage(val) {
      Page = val;
      changePage(0);
    }

    function ShowSelect(val) {
      switch (val) {
        case "香港": {
          document.getElementById('select_hk').style.display = "inline-block";
          document.getElementById('select_kw').style.display = "none";
          document.getElementById('select_nt').style.display = "none";
          break;
        }
        case "九龍": {
          document.getElementById('select_hk').style.display = "none";
          document.getElementById('select_kw').style.display = "inline-block";
          document.getElementById('select_nt').style.display = "none";
          break;
        }
        case "新界": {
          document.getElementById('select_hk').style.display = "none";
          document.getElementById('select_kw').style.display = "none";
          document.getElementById('select_nt').style.display = "inline-block";
          break;
        }
      }
    }
  </script>
  <script>
    var x = document.getElementById("demo");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);

      } else {
        alert("Geolocation is not supported by this browser.");
      }
      document.getElementById('weodiCheckBox').checked = false;
    }

    function showPosition(position) {
      document.getElementById('Latitude').value = position.coords.latitude;
      document.getElementById('Longitude').value = position.coords.longitude;
      document.getElementById('abc').innerHTML = '<iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=' + 22.3669512 + ',' + 114.1384574 + '&hl=es&z=14&amp;output=embed"></iframe>';
    }
  </script>
</head>

<body>
  <?php include('header.php'); ?>

  <div id="post">
    <div id="searchResultTittle">
      <b>發佈貼文</b>
    </div>
    <div id="postState">
      <table>
        <td>
          <div id="postState_1" class="postState" onclick="juimpPage(1)">
            <div>1</div> 寵物資料
          </div>
        </td>
        <td>
          <div id="postState_2" class="postState" onclick="juimpPage(2)">
            <div>2</div> 遺失詳情
          </div>
        </td>
        <td>
          <div id="postState_3" class="postState" onclick="juimpPage(3)">
            <div>3</div> 聯絡方法
          </div>
        </td>
      </table>
    </div>
    <div id="inputData">
      <form action="post.php" id="postForm" method="post" enctype="multipart/form-data">
        <div id="inputData_page1">
          <div id="uploadPhotoDiv">

            <input type="file" accept="image/*" id="myFile" name="uploadfile" onchange="init(event)">

            <div id="displayInputImage">
              <img src="web_image/defult.jpg" id="uploadPreview" alt="">
            </div>
          </div>
          <div id="mapIframe">
            <iframe id="theiframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.295565782106!2d114.10474987397231!3d22.34246600397562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f8d2dc85656f%3A0xe52d12c0080581c8!2z6aaZ5riv5bCI5qWt5pWZ6IKy5a246ZmiKOmdkuiho-WIhuagoSk!5e0!3m2!1szh-TW!2shk!4v1674895679513!5m2!1szh-TW!2shk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div id="postTypeBackground">
            <label id="lostTypelbl" for="lostType" class="label" onclick="jingPianDisplay(true)"><b>遺失</b></label>
            <label id="findTypelbl" for="findType" class="label" onclick="jingPianDisplay(false)"><b>拾獲</b></label>
          </div>
          <div id="InputFormP1">
            <b style="font-size:25px;">寵物資料</b><br><br>
            <input type="radio" id="lostType" name="postType" value="lostpet" checked>
            <input type="radio" id="findType" name="postType" value="getpet">

            <div id="form_inputVariety_div">種類: <input type="radio" name="Pet_Types" value="cat" id="inputVariety_cat" checked required>貓
              <input type="radio" id="inputVariety_dog" name="Pet_Types" value="dog" required>狗
              <input type="radio" id="inputVariety_other" name="Pet_Types" value="other" required>其他
            </div>
            <div id="form_inputChip_div">晶片: <input type="radio" name="Pet_chip" value="hasChip" checked required>有
              <input type="radio" name="Pet_chip" value="noChip" required>沒有
            </div>
            <br>
            <div id="form_inputSex_div">性別: <input type="radio" name="Pet_Sex" value="boy" checked required>男
              <input type="radio" name="Pet_Sex" value="girl" required>女
              <input type="radio" name="Pet_Sex" value="otherSex" required>不明
            </div>
            <br>
            <div class="form form_PetName">
              <input type="text" name="Pet_Name" autocomplete="off" title="寵物名稱" required>
              <label for="name" class="label-name">
                <span class="content-name">名稱</span>
              </label>
            </div>
            <div class="form form_inputPet_color">
              <input type="text" name="Pet_color" id="petColor" autocomplete="off" title="顏色" required>
              <label for="Pet_color" class="label-name">
                <span class="content-name">顏色</span>
              </label>
            </div>
            <div class="form form_inputAge">
              <input type="number" name="Pet_Age" autocomplete="off" title="年齡" max="50" min="0" required>
              <label for="Pet_Age" class="label-name">
                <span class="content-name">年齡</span>
              </label>
            </div>

            <div class="form form_inputWeight">
              <input type="number" name="Pet_weight" autocomplete="off" title="體重" step="0.1" max="50" min="0" required>
              <label for="Pet_weight" class="label-name">
                <span class="content-name">體重 <small style="color:grey"> kg</small></span>
              </label>
            </div>
            <br>

            <div class="form form_inputVariety">
              <input type="text" name="Pet_Description" id="petVariety" autocomplete="off" title="品種" required>
              <label for="Pet_Description" class="label-name">
                <span class="content-name">品種 <small style="color:grey"> （例如：混種短毛貓）</small></span>
              </label>
            </div>

            <div class="form form_inputFeature">
              <input type="text" name="Pet_feature" autocomplete="off" maxlength="50" title="特徵" required>
              <label for="Pet_feature" class="label-name">
                <span class="content-name">特徵 <small style="color:grey"> （例如：親近人，右前腳有斑點）</small></span>
              </label>
            </div>
            <div>

              <input type="text" name="lost_ID" value="<?php echo $row['lost_ID'];?>" style="display:none" readonly />
              <input type="text" name="Pet_ID" style="display:none" value="<?php echo $row['Pet_ID'];?>" readonly />
            </div>
          </div>
        </div>
        <div id="InputFormP2" style="display:none">
          <b style="font-size:25px;">走失詳情</b><br><br>
          <div id="lostDay">日期: <input type="date" name="date" id="inputDay" title="走失日期" style='font-size: 15px;'></div>
          <div id="lostTime">時間: <input type="time" name="time" title="走失時間" style='font-size: 15px;'></div><br>
          <div id="lostArea">地區:
            <select name="area" id="select_Area" style="font-size:18px">
              <option value="hk" class="disabledOption" style="text-align: left;" disabled>-香港</option>
              <option value="中西區">中西區</option>
              <option value="灣仔">灣仔</option>
              <option value="東區">東區</option>
              <option value="南區">南區</option>

              <option value="kw" class="disabledOption" style="text-align: left;" disabled>-九龍</option>
              <option value="深水埗">深水埗</option>
              <option value="油尖旺">油尖旺</option>
              <option value="黃大仙">黃大仙</option>
              <option value="觀塘">觀塘</option>
              <option value="九龍城">九龍城</option>

              <option value="nt" class="disabledOption" style="text-align: left;" disabled>-新界</option>
              <option value="深水埗">深水埗</option>
              <option value="葵青">葵青</option>
              <option value="荃灣">荃灣</option>
              <option value="屯門">屯門</option>
              <option value="沙田">沙田</option>
              <option value="大埔">大埔</option>
              <option value="北區">北區</option>
              <option value="西貢">西貢</option>
              <option value="離島">離島</option>
            </select>
          </div>
          <input type="text" name="Place" id="lostPetDidian" title="走失地點" placeholder="地點">
          <br>
          <div class="form_inputWeiDu" style="width:500px;">
            <div id="weiduId">
              緯度: <input type="text" name="latitudeAndLongitude" title="緯度" id="Latitude" style="display:inline-block" autocomplete="off" class="weidu">
              經度:<input type="text" name="latitudeAndLongitude" title="經度" id="Longitude" style="display:inline-block" autocomplete="off" class="weidu"></div>
            <div id="getWeiDuDiv"><input onclick="getLocation()" name="weoDiCheckBox" id="weodiCheckBox" type="checkbox" style="display:none">
              <label for="weodiCheckBox">獲取你的座標</label>
            </div>
          </div>
          <div class="form form_LostPetDetial" style="width:350px;margin-left:5px;">
            <input type="text" name="Details" title="走失詳情" autocomplete="off" maxlength="50" required>
            <label for="Details" class="label-name">
              <span class="content-name"><b>走失詳情</b></span>
            </label>
          </div><br>
        </div><br>



        <div id="InputFormP3" style="display:none">
          <b style="font-size:25px;">聯絡方法</b><br>
          <div class="form form_inputConnectName">
            <input type="text" name="ConnectName" title="聯絡人姓名" autocomplete="off" required>
            <label for="ConnectName" class="label-name">
              <span class="content-name">聯絡人姓名</span>
            </label>
          </div><br>
          <input type="text" name="ConnectNumber" title="電話號碼" class="phoneNumberInput" autocomplete="off" placeholder="電話號碼(可選)">
          <br>
          <input type="text" id="othercon" title="其他聯絡方法" name="OtherConnect" class="otherConnectInput" autocomplete="off" placeholder="其他(例如:whatsapp,email)">
        </div>

        <button type="submit" id="formSubmitBtn" class="changePageBtn">提交</button>
        <div id="NextPage" class="changePageBtn" onclick="changePage(+1)">下一頁</div>
        <div id="lastPage" class="changePageBtn" onclick="changePage(-1)">上一頁</div>
      </form>
    </div>


    <br>
    <br>
  </div>
  <script type="text/javascript">
    var btnSend = document.getElementById('formSubmitBtn');
    btnSend.addEventListener('click', function() {
      var isValid = validateForm();
      if (isValid)
        console.log('Form is ready to submit.');
    });

    function validateForm() {
      var formToValidate = document.getElementById('postForm');
      var elements = formToValidate.elements;
      var i;

      for (i = 0; i < elements.length; i++) {
        if (elements[i].type == 'text') {
          //replace this with your actual validation
          var invalid = elements[i].value.length == 0;
          if (invalid) {
            alert("請填寫" + elements[i].title);
            break;
            //return false;
          }
        }
      }
      //return true;
    }
  </script>

  <?php
    include "conn.php";  //include "Connections/conn.php";//include "conn.php";
    //var_dump($_POST);
    if (!isset($_POST['lost_ID'])) {
    } else {
        echo "Will run a SQL INSERT statement";

    //! test

    $filename = $_FILES["uploadfile"]["name"];

    echo "<h3>   test check</h3>";
    //var_dump($filename);
    echo "<h3>   test check</h3>";

    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    //! test
        extract($_POST);
        $sql = "INSERT INTO `pet`(`Pet_ID`, `Pet_Types`, `Pet_Name`, `Pet_Sex`, `Pet_Age`, `Pet_weight`, `Pet_chip`, `Pet_Description`, `Pet_feature`, `Pet_color`, `Pet_image`) VALUES 
        ('$Pet_ID','$Pet_Types','$Pet_Name','$Pet_Sex','$Pet_Age','$Pet_weight','$Pet_chip','$Pet_Description','$Pet_feature','$Pet_color', '$filename');"; //filename

        try{
            mysqli_query($conn, $sql);
            echo "<h3>   test 1</h3>";
            //! test
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Image uploaded successfully! test </h3>";
            } else {
                echo "<h3>  Failed to upload image!     test </h3>";
            }
            //! test
        }
        catch (exception $e){

        }
        $num = mysqli_affected_rows($conn);
        if ($num == 1){
            echo "<h2>A record is added successfully</h2>";
//todo:  ==============                          the ***User_ID*** is hard code                                ==========
$sql = "INSERT INTO `lost_post`(`lost_ID`, `User_ID`, `Pet_ID`, `date`, `time`, `area`, `Place`, `Details`, `coordinate`, `latitude`,`longitude`) VALUES 
('$lost_ID',' $_SESSION[User_ID]','$Pet_ID','$date','$time','$area','$Place','$Details','123','$latitudeAndLongitude1','$latitudeAndLongitude2')";
try{
                mysqli_query($conn, $sql);
            }
            catch (exception $e){

            }
            $num = mysqli_affected_rows($conn);
            if ($num == 1){
                echo "<h2>A record is added successfully</h2>";
            }
            else
                echo "<h2>Record already exist!</h2>";
//todo : ==============                          the ***User_ID*** is hard code                                ==========
        }
        else
            echo "<h2>Record already exist!</h2>";
        mysqli_close($conn);
        //header("location:lost_post_add.php"); //! header newd change    ============== location:lost_post_add.php?mag=successfully
        //window.location.href='lost_post_add.php';
        //header("location:lost_post_view.php?Pet_ID=$Pet_ID");

        //header("location:lost_post_add.php");
        ob_end_flush();


    }
    ?>
  <!--<iframe src="map.html" height="400" width="400" title="google Map"></iframe>-->
  <!--<div id="abc"></div>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5175.835699454278!2d114.13585300502555!3d22.369300863044735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f89cb1117029%3A0xe0f98901d59a8980!2z6I2D54Gj57Wy6bqX6YWS5bqX!5e0!3m2!1szh-TW!2shk!4v1676954840462!5m2!1szh-TW!2shk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
-->
</body>

</html>