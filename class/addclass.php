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
    <link rel="stylesheet" href="addclass.css">
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
	<form action="classadded.php" method="post">
			<h1> Class Information <h1>
			<div class="group">
				<label for = "section">Section For Subject to be Added to</label><br>
				<input type="text" name="section" value="">
			</div>
			<h1> Subject Information <h1>
			<div class="group">
				<label for = "subject">Subject</label><br>
				<input type="text" name="subject" value="">
			</div>
			<div class="group">
				<label for = "title">Title</label><br>
				<input type="text" name="title" value="">
			</div>
			<h1> Criteria Information <h1>
			<div class="group">
				<label for = "s_type">Type</label><br>
				<input type="text" name="s_type" value="Seatwork" disabled>
			</div>
			<div class="group">
				<label for = "s_reqs">Reqs</label><br>
				<input type="text" name="s_reqs" value="">
			</div>
			<div class="group">
				<label for = "s_weight">Weight</label><br>
				<input type="text" name="s_weight" value="">
			</div>
			<br>
			<div class="group">
				<label for = "q_type">Type</label><br>
				<input type="text" name="q_type" value="Quizzes" disabled>
			</div>
			<div class="group">
				<label for = "q_reqs">Reqs</label><br>
				<input type="text" name="q_reqs" value="">
			</div>
			<div class="group">
				<label for = "q_weight">Weight</label><br>
				<input type="text" name="q_weight" value="">
			</div>
			<br>
			<div class="group">
				<label for = "e_type">Type</label><br>
				<input type="text" name="e_type" value="Exams" disabled>
			</div>
			<div class="group">
				<label for = "e_reqs">Reqs</label><br>
				<input type="text" name="e_reqs" value="">
			</div>
			<div class="group">
				<label for = "e_weight">Weight</label><br>
				<input type="text" name="e_weight" value="">
			</div>
			<input type="submit" name="submit" value="Add">
		</form>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </body>
</html>