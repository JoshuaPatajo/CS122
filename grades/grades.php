<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Grades</title>

    <!-- CSS -->

    <link rel="stylesheet" href="grades.css?version=2">
    <link rel="stylesheet" href="..\assets\header.css">
    <link rel="stylesheet" href="..\assets\scrollbar.css">
    <link rel="stylesheet" href="..\assets\back.css">
    <link href="../assets/Hover-master/css/hover.css" rel="stylesheet" media="all">
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

      <form action="grades.php" method="post" enctype="multipart/form-data">
        <div id="import">
            <label class="upload-btn-wrapper">
              <button type="button" name="button">Choose file</button>
               <input type="file" name="fileupload" id="fileupload"/>
            </label>

        </div>
          <input type="submit" name="submit" value="Import">
      </form>
      <form action="gradesadded.php" method="post">
        <input type='submit' name='submit' value='Send to database'>
      </form>

  <?php

  if(isset($_POST["submit"])) {
    $row = 1;
    $reqdata = array();
    $tableheadings = array();
    $actualdata = array();

    $currentDir = getcwd();
    $uploadDirectory = "\uploads\\";

    $fileName = $_FILES['fileupload']['name'];
    $fileSize = $_FILES['fileupload']['size'];
    $fileTmpName  = $_FILES['fileupload']['tmp_name'];
    $fileType = $_FILES['fileupload']['type'];

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName);

    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    $a = 0;
    if (($handle = fopen($uploadPath, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

    		//getting the data from csv
    		if($row <= 4){ //data on qtr,yr,adviser,section
    			$reqdata[] = $data[1];
    		}elseif($row == 5){ //table headings
    			$num = count($data);
    			for ($c=0; $c < $num; $c++) {
    				$tableheadings[] = $data[$c];
    			}

    		}else{
    			$num = count($data);
    			for ($c=0; $c < $num; $c++) {
    				$actualdata[] = $data[$c];
    			}
    		}

        $_SESSION['tableh'] = $tableheadings;
        $_SESSION['actuald'] = $actualdata;
        $_SESSION['reqd'] = $reqdata;

    		//printing table
    		if($row == 1){
    			echo"<div id='info'>Quarter: $data[1]<br>";
    		}elseif($row == 2){
    			echo"School Year: $data[1]<br>";
    		}elseif($row == 3){
    			echo"Adviser: $data[1]<br>";
    		}elseif($row == 4){
    			echo"Section: $data[1]</div>";
    		}elseif($row == 5){
    			echo"<div id='wrapper'><table name='data'><tr>";
    			for($k = 0; $k < count($tableheadings); $k++){
    				echo "<th>{$tableheadings[$k]}</th>";
    			}
    			echo"</tr>";
    		}else{
    			echo"<tr>";
    			for($k = 0; $k < count($tableheadings); $k++){
    				$tmp = $a+$k;
    				echo "<td>{$actualdata[$tmp]}</td>";
    			}
    			echo"</tr>";
    			$a +=count($tableheadings);
    		}
            $row++;
        }
        fclose($handle);
    }
    echo "</table></div>";
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
