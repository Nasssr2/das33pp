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

 
  <div id="searchResult">


    <div id="searchResultTittle">
      <b>add寵物</b>
    </div>

   
<div align="center" class="o">
    <form action="lost_post_add.php" method="post" enctype="multipart/form-data">
        <table border="0" style="border-collapse: collapse;">
            <!--       間線厚度                   表格風格-->
            <tr>
                <td>
                    <input class="form-control" type="file" name="uploadfile" value="" />
                </td>
            </tr>
            <tr>
                <td>個案id :</td>
                <td>
                    <input type="text" name="lost_ID" value="<?php echo $row['lost_ID'];?>" readonly/>
                    <input type="text" name="Pet_ID" value="<?php echo $row['Pet_ID'];?>" readonly/>
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Pet_Types :</td>
                <td>
                    <textarea type="text" cols="50" rows="4" name="Pet_Types"  /*required*/>value="dog"  </textarea>
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td>Pet_Name :</td>
                <td>
                    <textarea  type="text" name="Pet_Name" cols="50" rows="4"  /*required*/ >value="dog"</textarea>
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td>Pet_Sex :</td>
                <td>
                    <input type="text" name="Pet_Sex" value="dogdogdog" /*required*//>
                </td>
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td>Pet_Age :</td>
                <td>
                    <input type="text" name="Pet_Age" value="11" /*required*//>
                </td>
            </tr>
            <tr>
                <td>Pet_weight :</td>
                <td>
                    <input type="text" name="Pet_weight" value="11" /*required*//>
                </td>
            </tr>
            
            <tr>
                <td>Pet_chip :</td>
                <td>
                    <input type="text" name="Pet_chip" value="dogdogdog" /*required*//>
                </td>
            </tr>
            <tr>
                <td>Pet_Description :</td>
                <td>
                    <input type="text" name="Pet_Description" value="dogdogdog" /*required*//>
                </td>
            </tr>
            <tr>
                <td>Pet_feature :</td>
                <td>
                    <input type="text" name="Pet_feature" value="dogdogdog" /*required*//>
                </td>
            </tr>
            <tr>
                <td>Pet_color :</td>
                <td>
                    <input type="text" name="Pet_color" value="dogdogdog" /*required*//>
                </td>
            </tr>
            <tr>
                <td>date :</td>
                <td>
                    <input type="date" name="date" value="2023-01-01" /*required*//>
                </td>
            </tr>
            <tr>
                <td>time :</td>
                <td>
                    <input type="time" name="time" value="13:21:00" /*required*//>
                </td>
            </tr>
            <tr>
                <td>area :</td>
                <td>
                    <input type="text" name="area" value="dogdogdog" /*required*//>
                </td>
            </tr>
            <tr>
                <td>Place :</td>
                <td>
                    <input type="text" name="Place" value="dogdogdog" /*required*//>
                </td>
            </tr>
            <tr>
                <td>Details :</td>
                <td>
                    <input type="text" name="Details" value="dogdogdog" /*required*//>
                </td>
            </tr>
            <tr>
                <td>coordinate :</td>
                <td>
                    <input type="text" name="coordinate" value="dogdogdog" /*required*//>
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


    <?php
    include "conn.php";  //include "Connections/conn.php";//include "conn.php";


    //var_dump($_POST);
    if (!isset($_POST['lost_ID'])) {
    } else {
        echo "Will run a SQL INSERT statement";

    //! test

    $filename = $_FILES["uploadfile"]["name"];

    echo "<h3>   test check</h3>";
    var_dump($filename);
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
            $sql = "INSERT INTO `lost_post`(`lost_ID`, `User_ID`, `Pet_ID`, `date`, `time`, `area`, `Place`, `Details`, `coordinate`) VALUES 
                ('$lost_ID','1','$Pet_ID','$date','$time','$area','$Place','$Details','$coordinate')";
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
</div>
<button onclick="window.location.href='products.php'" class="button1">back</button>&nbsp;



    <!-- </table> -->

  </div>


</body>

</html>