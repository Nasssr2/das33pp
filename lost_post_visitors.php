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
include('header_visitors.php'); 
//var_dump($_GET); //!is good
?>


  <form action="lost_post_visitors.php" method="get">
    <div id="search">
      <!-- <div id="searchLost" class="searchType">
        <div><b>遺失寵物</b></div>
      </div>
      <div id="searchFind" class="searchType">
        <div><b>拾獲寵物</b></div>
      </div> -->
      <div id="selectVariety" class="searchType searchSelect">
        <div><b>寵物種類:</b>&nbsp;
          <select name="variety" id="select_Variety">
            <option value="all">全部</option>
            <option value="cat">貓</option>
            <option value="dog">狗</option>
            <option value="other">其他</option>
          </select>
        </div>
      </div>
      <div id="selectArea" class="searchType searchSelect">
        <div><b>地區:</b>&nbsp;
          <select name="area" id="select_Area">
          <option value="全部">全部</option>
            <option value="hk" class="disabledOption" disabled>-香港</option>
            <option value="中西區">中西區</option>
            <option value="灣仔">灣仔</option>
            <option value="東區">東區</option>
            <option value="南區">南區</option>


            <option value="kw" class="disabledOption" disabled>-九龍</option>
            <option value="深水埗">深水埗</option>
            <option value="油尖旺">油尖旺</option>
            <option value="黃大仙">黃大仙</option>
            <option value="觀塘">觀塘</option>
            <option value="九龍城">九龍城</option>


            <option value="nt" class="disabledOption" disabled>-新界</option>
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
      </div>
      <input id="searchBtn" class="searchType" type="submit" value="search" class="button1">&nbsp;
   
      
    </div>
  </form>

  <div id="searchResult">
    <div id="searchResultTittle">
      <b>遺失寵物</b>
    </div>

    <?php
      require_once('conn.php');   # or use : include 'conn.php';
      //$sql = "SELECT * FROM lost_post"; //! need change
      
      if (isset($_GET['variety'])){
        if ($_GET['variety'] == 'all'){
          $sql = "SELECT Pet_image, Pet_Types, pet.Pet_Name, area, Place, time, date, lost_post.Pet_ID FROM lost_post, pet WHERE lost_post.Pet_ID=pet.Pet_ID";
        }else
        $sql = "SELECT Pet_image, Pet_Types, pet.Pet_Name, area, Place, time, date, lost_post.Pet_ID FROM lost_post, pet WHERE lost_post.Pet_ID=pet.Pet_ID AND Pet_Types LIKE'{$_GET['variety']}'";
      }else{
        $sql = "SELECT Pet_image, Pet_Types, pet.Pet_Name, area, Place, time, date, lost_post.Pet_ID FROM lost_post, pet WHERE lost_post.Pet_ID=pet.Pet_ID"; //! need change
      }


      $rs = mysqli_query($conn, $sql);
      while ($rc = mysqli_fetch_assoc($rs)) {
        extract($rc);  // create new variables $custID, $custName, $custPswd, $custGender

        // heredoc can simplify the syntax to output HTML code embedded with PHP variables
echo <<<EOD
        <div class="postedPost">
        <a href="lost_post_view_visitors.php?Pet_ID=$Pet_ID" style="color:black; text-decoration:none">
        <div class="postedPostImage">

EOD;
        ?>
        <img src="./image/<?php echo $rc['Pet_image']; ?>">
        <?php
echo    <<<EOD

        </div>
        <div class="container"><b>$Pet_Types : $Pet_Name</b><br><b>$area $Place</b><br><b>$date $time</b></div>
        </div>
EOD;
      }
      mysqli_free_result($rs);
      mysqli_close($conn);
    ?>
    <!-- </table> -->

  </div>



  
</body>
</html>