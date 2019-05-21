<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grades Added</title>

    <link rel="stylesheet" href="gradesadded.css?version=1">
    <link rel="stylesheet" href="..\assets\header.css">
    <link rel="stylesheet" href="..\assets\scrollbar.css">
    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <link href="../assets/fontawesome/css/fontawesome-all.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="header"><img src="../assets/ths.png" alt=""> T.I.S.I.S</div>
    <div id="container">

      <?php

      $tableheadings = $_SESSION['tableh'];
      $actualdata =  $_SESSION['actuald'];
      $reqdata = $_SESSION['reqd'];
//start of the insert to database code
$count = count($tableheadings);
$count = (count($actualdata) +1)/ ($count+1);


$qtr = $reqdata[0];
$yr = $reqdata[1];
$adviser = $reqdata[2];
$sec = $reqdata[3];
require '../assets/connect.php';
$c = 0;

//loop thru rows of data
for($i = 0; $i < $count; $i++){


	//inserting the grades per subject of a student
	for($j = 0; $j < count($tableheadings)-2; $j++){

		//find subject code
		$subjname = $tableheadings[2+$j];
		$sql = "SELECT * FROM subject WHERE description='$subjname'";
		$result = mysqli_query($dbc, $sql) or die("Bad subject query");
		$row = mysqli_fetch_assoc($result);

		//insertion
		$query = "INSERT INTO grades(grade, subjectcode, studentID, quarter, schoolyear) VALUES (?,?,?,?,?)";

		$stmt = mysqli_prepare($dbc, $query);

		$stmt->bind_param("iiiis", $grade, $sc, $studentID, $quarter, $schoolyear);

		$grade = $actualdata[$c+2+$j];
		$sc = $row['subjectcode'];
		$studentID = $actualdata[$c];
		$quarter = $qtr;
		$schoolyear = $yr;

		//execute
		mysqli_stmt_execute($stmt) or die(mysqli_error($dbc));
	}

	//insert adviser for the student
	$query = "INSERT INTO adviser(name, studentID, quarter, schoolyear) VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($dbc, $query);

	$stmt->bind_param("siis", $name, $studentID, $quarter, $schoolyear);

	$name = $adviser;
	$studentID = $actualdata[$c];
	$quarter = $qtr;
	$schoolyear = $yr;

	//execute
	mysqli_stmt_execute($stmt) or die(mysqli_error($dbc));

	//insert section for the student
	$query = "INSERT INTO section(section, studentID, quarter, schoolyear) VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($dbc, $query);

	$stmt->bind_param("siis", $section, $studentID, $quarter, $schoolyear);

	$section = $sec;
	$studentID = $actualdata[$c];
	$quarter = $qtr;
	$schoolyear = $yr;

	//execute
	mysqli_stmt_execute($stmt) or die(mysqli_error($dbc));

	$c += count($tableheadings);
}
echo "<i class='far fa-plus-square'></i><br>
Grades have been successfully added!<br>
<a href='grades.php'><button type='button' name='button'>Add More Grades</button></a>
<a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";

?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
      <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>
