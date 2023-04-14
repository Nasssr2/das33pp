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
include('header.php'); 
require_once('conn.php');
//var_dump($_GET); //!is good
extract($_GET);
$sql = " SELECT * FROM user  WHERE User_ID = '$User_ID'";
    $rs = mysqli_query($conn, $sql) or die ('<div class = "error"> SQL command fails : <br> ' . mysqli_error($conn) . " </div> ");// $ rs is the result set
    $num = mysqli_num_rows($rs);
    $rec = mysqli_fetch_assoc($rs);
    extract($rec);
    //var_dump($rec);
    
    echo  <<<EOD
    <div id="searchResult" align="center">
    <div id="searchResultTittle">
      <b>人員資料更改</b>
    </div>
    <form action="list_user_edit_fun.php" method="post">
        <table border="0" style="border-collapse: collapse; margin:0 auto;">
            <!--       間線厚度                   表格風格-->
            <tr>
                <td>User_ID :</td>
                <td>
                    <input type="email" name="email" value="$User_ID"required>
                </td>
            </tr>
            <tr>
                <td> </td>
            </tr>
            <!--        一整個空行-->
            <tr>
                <td>User_Name :</td>
                <td>
                    <input type="text" name="CTName" value="$User_Name"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
            <td>phone_Number :</td>
            <td>
                <input type="text" name="CTName" value="$phone_Number"/>
            </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>password :</td>
                <td>
                    <input type="text" maxlength="8" pattern="[0-9]*" title="Only number" name="Phum" value="$password"/>
                </td>
            </tr>
            <tr>
                <td>name :</td>
                <td>
                    <input type="text" maxlength="8" pattern="[0-9]*" title="Only number" name="Phum" value="$name"/>
                </td>
            </tr>
            <tr>
                <td>user_Email :</td>
                <td>
                    <input type="text" maxlength="8" pattern="[0-9]*" title="Only number" name="Phum" value="$user_Email"/>
                </td>
            </tr>
            <tr>
                <td> </td>
            </tr>

        </table>
        <br />
        <input type="submit" value="Update Record" class="button1">&nbsp;
        <input type="reset" value="Clear Form" class="button1" />
        <button onclick="window.location.href='customer.php'" class="button1">back</button>


    </form>
EOD;
?>
</div>
</div>