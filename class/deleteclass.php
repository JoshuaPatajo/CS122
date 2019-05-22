<?php
session_start();

$subjectID = $_GET['subjectID'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Edited</title>

    <link rel="stylesheet" href="deleteclass.css?version=1">
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
    <div id="header"><img src="../assets/ths.png" alt="">T.I.S.I.S</div>
    <div id="container">
  <?php

	require '../assets/connect.php';

	$query = "DELETE FROM Grading_Period WHERE subjectID = '$subjectID'";
	$stmt = mysqli_prepare($dbc, $query);
	mysqli_stmt_execute($stmt);

	$query = "SELECT criteriaID FROM Criteria WHERE subjectID = '$subjectID'";
	$result = mysqli_query($dbc, $query) or die("Bad S query");

	while($row = mysqli_fetch_assoc($result)) {
		$cid = $row['criteriaID'];
		$query = "SELECT requirementID FROM Requirement WHERE criteriaID = '$cid'";
		$res = mysqli_query($dbc, $query) or die("Bad S query");

		while($r = mysqli_fetch_assoc($res)) {
			$rid = $r['requirementID'];
			$query = "DELETE FROM Student_Grade WHERE requirementID = '$rid'";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_execute($stmt);
		}

		$query = "DELETE FROM Requirement WHERE criteriaID = '$cid'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$query = "DELETE FROM Criteria WHERE criteriaID = '$cid'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);
	}

	$query = "DELETE FROM Subject WHERE subjectID= '$subjectID'";
	$stmt = mysqli_prepare($dbc, $query);
	mysqli_stmt_execute($stmt);

	echo "<i class='fas fa-user'></i><br>
	Class has been successfully deleted!<br>
	<a href='class.php'><button type='button' name='button'>View Classes</button></a>
	<a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";

	mysqli_close($dbc);

?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
      <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>