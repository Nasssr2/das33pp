<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>遺失寵物互助網</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/index_mobile.css" media="screen and (max-width: 768px)">
  <script src="jslib/jquery-3.4.1.js"></script>
  <script type="text/javascript" src="jslib/index.js"></script>
  <link rel="stylesheet" href="css/lost_post_view.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/lost_post_view_mobile.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
  </script>
  <script type="text/javascript">
    function setImg() {
      alert(document.getElementById("petImg2").src);
    }
  </script>
</head>

<body>
<?php include('header.php'); ?>
 
  <?php
    require_once('conn.php');
    extract($_GET);
    $sql = "SELECT * FROM get_post NATURAL JOIN pet NATURAL JOIN user WHERE Pet_ID = '$Pet_ID'";
    $rs = mysqli_query($conn, $sql) or die ('<div class = "error"> SQL command fails : <br> ' . mysqli_error($conn) . " </div> ");// $ rs is the result set
    $num = mysqli_num_rows($rs);
    $rec = mysqli_fetch_assoc($rs);
    extract($rec);
  ?>
  <div id="searchResult">
    <div id="searchResultTittle">
      <b>遺失寵物</b>
    </div>


    <div id="petImgDiv"><img id="petImg" src="./image/<?php echo $rec['Pet_image']; ?>"></div>

    <div id="PetName" class="data"><?php echo $rec['Pet_Name']; ?></div>

    <fieldset id="PetData">
      <legend>寵物資料:</legend>
      <label>年齡:</label><label><?php echo $rec['Pet_Age']; ?></label><br>
      <label>品種:</label><label><?php echo $rec['Pet_Description']; ?></label><br>
      <label>性別:</label><label><?php echo $rec['Pet_Sex']; ?></label><br>
      <label>體重:</label><label><?php echo $rec['Pet_weight']; ?></label><br>
      <label>晶片:</label><label><?php echo $rec['Pet_chip']; ?></label><br>
      <label>顏色:</label><label><?php echo $rec['Pet_color']; ?></label><br>
      <label>特徵:</label><label><?php echo $rec['Pet_feature']; ?></label><br>
    </fieldset>
    <fieldset id="Contact">
      <legend>聯絡人資料:</legend>
      <label>聯絡人:</label><label><?php echo $rec['name']; ?></label><br>
      <label>電話:</label><label><?php echo $rec['phone_Number']; ?></label><br>
    </fieldset>
    <fieldset id="LostDayTime">
      <legend>走失日期:</legend>
      <label>日期:</label><label><?php echo $rec['date']; ?></label><br>
      <label>時間:</label><label><?php echo $rec['time']; ?></label><br>
    </fieldset>
    <fieldset id="LostPlace">
      <legend>走失地點:</legend>
      <label>地區:</label><label><?php echo $rec['area']; ?></label><br>
      <label>位置:</label><label><?php echo $rec['Place']; ?></label><br>
      <label>詳情:</label><label><?php echo $rec['Details']; ?></label><br>
    </fieldset>
    <fieldset id="LostPlaceMap">
      <iframe id="thisIframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4473.939721148604!2d114.10550577964193!3d22.33940673422209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f8d2dc85656f%3A0xe52d12c0080581c8!2z6aaZ5riv5bCI5qWt5pWZ6IKy5a246ZmiKOmdkuiho-WIhuagoSk!5e0!3m2!1szh-TW!2shk!4v1674968357109!5m2!1szh-TW!2shk" width="1200" height="900" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </fieldset>

    <button id="button"  title="Generate PDF"><img src="web_image/pdf.png" alt="generate pdf btn"></button>

  </div>

    

    <div class="card" id="makepdf" style="display:none">
      <div>
        <h1>走失寵物 <?php echo $rec['Pet_Name']; ?></h1>
      </div>
      <table>
        <tr>
          <td><img style="width:400px;height:400px;" src="./image/<?php echo $rec['Pet_image']; ?>">
          </td>
          <td>
            <fieldset style="width:300px;">
              <legend>寵物資料:</legend>
              <label>年齡:</label><label><?php echo $rec['Pet_Age']; ?></label><br>
              <label>品種:</label><label><?php echo $rec['Pet_Description']; ?></label><br>
              <label>性別:</label><label><?php echo $rec['Pet_Sex']; ?></label><br>
              <label>體重:</label><label><?php echo $rec['Pet_weight']; ?></label><br>
              <label>晶片:</label><label><?php echo $rec['Pet_chip']; ?></label><br>
              <label>顏色:</label><label><?php echo $rec['Pet_color']; ?></label><br>
              <label>特徵:</label><label><?php echo $rec['Pet_feature']; ?></label><br>
            </fieldset>
            <fieldset id="Contact">
              <legend>聯絡人資料:</legend>
              <label>聯絡人:</label><label><?php echo $rec['name']; ?></label><br>
              <label>電話:</label><label><?php echo $rec['phone_Number']; ?></label><br>
            </fieldset>
            <fieldset id="LostDayTime">
              <legend>走失日期:</legend>
              <label>日期:</label><label><?php echo $rec['date']; ?></label><br>
              <label>時間:</label><label><?php echo $rec['time']; ?></label><br>
            </fieldset>
          </td>
        </tr>
      </table>
      <fieldset id="LostPlace">
        <legend>走失地點:</legend>
        <label>地區:</label><label><?php echo $rec['area']; ?></label><br>
        <label>位置:</label><label><?php echo $rec['Place']; ?></label><br>
        <label>詳情:</label><label><?php echo $rec['Details']; ?></label><br>
      </fieldset>
      <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2873.177660010192!2d114.10872914868754!3d22.34036336720226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403ff68d4f197cf%3A0x670312e955576905!2z6Z2S6KGj56S-5Y2A6ZqU6Zui6Kit5pa9!5e0!3m2!1szh-TW!2shk!4v1674972184655!5m2!1szh-TW!2shk" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  <?php
    mysqli_free_result($rs);
    mysqli_close($conn);
  ?>
</body>
<script>
  var button = document.getElementById("button");
  var makepdf = document.getElementById("makepdf");

  button.addEventListener("click", function() {
    alert("如果pdf中的地圖沒有完整顯示,請隨意更改PDF配置以重新加載地圖");
    var mywindow = window.open("", "PRINT",
      "height=400,width=600");

    mywindow.document.write(makepdf.innerHTML);

    mywindow.document.close();
    mywindow.focus();

    mywindow.print();
    //mywindow.close();

    return true;
  });
</script>

</html>