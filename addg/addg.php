<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add by Group</title>

    <!-- CSS -->

    <link rel="stylesheet" href="addg.css?version=30">
    <link rel="stylesheet" href="..\assets\header.css">
    <link rel="stylesheet" href="..\assets\scrollbar.css">
    <link rel="stylesheet" href="..\assets\back.css">
    <link href="../assets/Hover-master/css/hover.css" rel="stylesheet" media="all">
	<link href="../assets/fontawesome/css/fontawesome-all.css" rel="stylesheet">
    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src=""></script>
    <![endif]-->
  </head>
  <body>
    <div id="header"><img src="../assets/ths.png" alt=""> T.I.S.I.S</div>
    <a href="../menu/menu.php"><div id="back"><i class="fas fa-arrow-left hvr-wobble-horizontal"></i></div></a>

    <div id="container">

      <form action="addg.php" method="post" enctype="multipart/form-data">
        <div id="import">
            <label class="upload-btn-wrapper">
              <button type="button" name="button" class="btn">Choose file</button>
               <input type="file" name="fileupload" id="fileupload"/>
            </label>
        </div>
          <input type="submit" name="submit" value="Import">
      </form>
      <form action='studentsadded.php' method='post'>
            <input type='submit' name='submit' value='Send to database'>
          </form>

   <?php
      $row = 1;
      $headings = array();
      $actual = array();

      if(isset($_POST["submit"])) {
        echo "<br /> Students To Be Added: <br />";
        if($_FILES['fileupload']['name']) {
          $filename = explode('.', $_FILES['fileupload']['name']);
          if(end($filename) == "csv") {
            $handle = fopen($_FILES['fileupload']['tmp_name'], "r");
            while($data = fgetcsv($handle, 1000, ","))
            {
              // $num = count($data);
              // echo "<p> $num fields in line $row: <br /></p>\n";
              // $row++;
              // for ($c=0; $c < $num; $c++) {
              //     echo $data[$c] . "<br />\n";
              // }
              $num = count($data);
              if($row == 1) {
                for($c = 0; $c < $num; $c++) {
                  $headings[] = $data[$c];
                }
              }
              else {
                if(!empty($data[0]) && !empty($data[2])) {
                  echo $data[0] . " " . $data[2] . "<br />";
                  for($c = 0; $c < $num; $c++) {
                    $actual[] = $data[$c];
                  }
                }
              }
              $row++;
              $_SESSION['tableh'] = $headings;
              $_SESSION['actuald'] =$actual;
              
            }
            fclose($handle);
          }
        }
      }
    ?>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </body>
</html>
