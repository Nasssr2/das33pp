<?php
ob_start();
//session_start();
// var_dump($_SESSION);
// var_dump($_POST);
//var_dump(session_id());
//var_dump(session_name());

// require_once('conn.php');
// $sql='SELECT IFNULL(max(lost_ID), 0)+1 AS "lost_ID" ,IFNULL(max(pet.Pet_ID), 0)+1 AS "Pet_ID" FROM lost_post, pet;';
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
// mysqli_free_result($result);
// mysqli_close($conn);
?>

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

  <script type="text/javascript">

  </script>
</head>

<body>
<?php include('header.php'); ?>

  <!-- <input type="hidden" name="customerID" value="$customerID">
  <input type="hidden" name="lost_ID" value="<?php echo $row['lost_ID'];?>" readonly/>
  <input type="text" name="Pet_ID" value="<?php echo $row['Pet_ID'];?>" readonly/> -->

  <div id="searchResult">


    <div id="searchResultTittle">
      <b>add寵物</b>
    </div>

    <?php
    include "conn.php";
    extract($_GET);
    $sql = " SELECT * FROM lost_post NATURAL JOIN pet NATURAL JOIN user WHERE Pet_ID = '$Pet_ID'";
    $rs = mysqli_query($conn, $sql) or die ('<div class = "error"> SQL command fails : <br> ' . mysqli_error($conn) . " </div> ");// $ rs is the result set
    $num = mysqli_num_rows($rs);
    $rec = mysqli_fetch_assoc($rs);
    extract($rec);
echo  <<<EOD
        <div align="center" class="o">
            <form action="lost_post_change_fun.php?Pet_ID=4" method="post">
                <table border="0" style="border-collapse: collapse;">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Pet_Types :</td>
                        <td>
                            <textarea type="text" cols="50" rows="4" name="Pet_Types"/*required*/>$Pet_Types  </textarea>
                            <input type="hidden" name="Pet_ID" value="$Pet_ID" readonly/>
                            <input type="hidden" name="lost_ID" value="$lost_ID" readonly/>
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>Pet_Name :</td>
                        <td>
                            <textarea  type="text" name="Pet_Name" cols="50" rows="4"  /*required*/ >$Pet_Name</textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>Pet_Sex :</td>
                        <td>
                            <input type="text" name="Pet_Sex" value="$Pet_Sex" /*required*//>
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>Pet_Age :</td>
                        <td>
                            <input type="text" name="Pet_Age" value="$Pet_Age" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>Pet_weight :</td>
                        <td>
                            <input type="text" name="Pet_weight" value="$Pet_weight" /*required*//>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Pet_chip :</td>
                        <td>
                            <input type="text" name="Pet_chip" value="$Pet_chip" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>Pet_Description :</td>
                        <td>
                            <input type="text" name="Pet_Description" value="$Pet_Description" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>Pet_feature :</td>
                        <td>
                            <input type="text" name="Pet_feature" value="$Pet_feature" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>Pet_color :</td>
                        <td>
                            <input type="text" name="Pet_color" value="$Pet_color" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>date :</td>
                        <td>
                            <input type="date" name="date" value="$date" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>time :</td>
                        <td>
                            <input type="time" name="time" value="$time" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>area :</td>
                        <td>
                            <input type="text" name="area" value="$area" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>Place :</td>
                        <td>
                            <input type="text" name="Place" value="$Place" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>Details :</td>
                        <td>
                            <input type="text" name="Details" value="$Details" /*required*//>
                        </td>
                    </tr>
                    <tr>
                        <td>coordinate :</td>
                        <td>
                            <input type="text" name="coordinate" value="$coordinate" /*required*//>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                    </tr>


                </table>
                <br />

                <input type="submit" value="Add Record" class="button1">&nbsp;
                <input type="reset" value="Clear Form" class="button1" />
            </form>
        <button onclick="window.location.href='products.php'" class="button1">back</button>&nbsp;
    <!-- </table> -->

  </div>
EOD;
  ?>

</body>

</html>