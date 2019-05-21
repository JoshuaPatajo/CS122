<?php
session_start();

$teacherID = $_SESSION['teacherID'];

require_once '../assets/connect.php';

$query = "SELECT title FROM Subject AS sbj, Grading_Period AS gp, Class as cl WHERE sbj.subjectID = gp.subjectID AND gp.teacherID = '$teacherID'";

$result = mysqli_query($dbc, $query) or die();
$subjects = mysqli_fetch_array($result);

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Grades</title>

    <!-- CSS -->

	<link rel="stylesheet" href="input-grades.css">
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
		<div id="header"><img src="../assets/ths.png" alt="">T.I.S.I.S</div>
    <a href="../menu/menu.php"><div id="back"><i class="fas fa-arrow-left hvr-wobble-horizontal"></i></div></a>

    <div id="container">
			<div class="tab">
				<button class="tablinks" value="edit">Edit Grades</button>
				<button class="tablinks" value="vts">View Top Students</button>
			</div>

			<div id="edit" class="tabcontent">
				<h3>Edit Grades</h3>
				<form class="grades-form">
					<h3>Select criteria</h3>
					<select>
						<>
						<option>Seatworks</option>
						<option>Quizzes</option>
						<option>Exams</option>
					</select>
					<table>
						<tr>
							<th>Reqirement</th>
							<th>Student score</th>
							<th>Highest possible score</th>
						</tr>
						<tr>
							<td>&ltSW1&gt</td>
							<td><input type="text" name="sw1"></td>
							<td>10</td>
						</tr>
					</table>
				<button type="submit" name="action">Save</button>
				</form>
			</div>

			<div id="vts" class="tabcontent">
				<h3>Top Students in &ltSubject&gt</h3>
				<table>
					<tr>
						<th>Rank</th>
						<th>Student</th>
					</tr>
					<tr>
						<td>1</td>
						<td></td>
					</tr>
					<tr>
						<td>2</td>
						<td></td>
					</tr>
					<tr>
						<td>3</td>
						<td></td>
					</tr>
					<tr>
						<td>4</td>
						<td></td>
					</tr>
					<tr>
						<td>5</td>
						<td></td>
					</tr>
					<tr>
						<td>6</td>
						<td></td>
					</tr>
					<tr>
						<td>7</td>
						<td></td>
					</tr>
					<tr>
						<td>8</td>
						<td></td>
					</tr>
					<tr>
						<td>9</td>
						<td></td>
					</tr>
					<tr>
						<td>10</td>
						<td></td>
					</tr>
				</table>
			</div>
  
  
		</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		<script>
		$(document).ready(function(){
			$(".tablinks").click(function(){
				$(".tabcontent").css("display", "none");
				$(".tablinks").removeClass("active");
				$(this).addClass("active");
				$("#"+$(this).val()).fadeIn();
			})
		})
		</script>

  </body>
</html>