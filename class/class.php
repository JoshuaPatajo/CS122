<?php
session_start();

$teacherID = $_SESSION['teacherID'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Search</title>

    <!-- CSS -->
    <link rel="stylesheet" href="class.css">
    <link rel="stylesheet" href="..\assets\header.css">
    <link rel="stylesheet" href="..\assets\back.css">
    <link rel="stylesheet" href="..\assets\scrollbar.css">
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
		<h1>Show All Classes of The teacher<h1>
		<?php

		require_once '../assets/connect.php';

		$query = "SELECT subjectID, section, count(*) AS studentcount FROM Grading_Period WHERE teacherID = '$teacherID' GROUP BY subjectID, section;";

		$result = mysqli_query($dbc, $query) or die("Bad S query");

		//print table
		echo"<div id='wrapper'><table name='data'>";
		echo"<tr><td>Subject</td><td>Class</td><td># of Students</td></tr>";
		while($row = mysqli_fetch_assoc($result)){ //fetch_all, fetch_array
		echo"<tr><td>{$row['subjectID']}</td><td>{$row['section']}</td><td>{$row['studentcount']}</td>
    <td><a href=viewclass.php?subject={$row['subjectID']}&section={$row['section']}>View</a></td><td><a href=editclass.php?subject={$row['subjectID']}&section={$row['section']}>Edit</a></td>
    <td><a href=deleteclass.php?subjectID={$row['subjectID']}>Delete</a></td></tr>";
		}
		echo "</table></div>";
	
		?>
		<a href=addclass.php>New Class</a>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </body>
</html>