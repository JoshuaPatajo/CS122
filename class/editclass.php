<?php
session_start();

$teacherID = $_SESSION['teacherID'];
$subjectID = $_GET['subject'];
$section = $_GET['section'];

$_SESSION['subject'] = $subjectID;

require_once '../assets/connect.php';

$query = "SELECT * FROM Criteria WHERE subjectID = '$subjectID'";
$result = mysqli_query($dbc, $query) or die("Bad S query");

$cid = array();
$type = array();
$reqs = array();
$weight = array();

while($row = mysqli_fetch_assoc($result)) {
	$cid[] = $row['criteriaID'];
	$type[] = $row['type'];
	$reqs[] = $row['number_of_requirements'];
	$weight[] = $row['weight'];
}

$_SESSION['cid'] = $cid;
$_SESSION['reqs'] = $reqs;

$query = "SELECT * FROM Class WHERE section = '$section'";
$result = mysqli_query($dbc, $query) or die("Bad S query");

while($row = mysqli_fetch_assoc($result)) {
	$sy = $row['school_year'];
	$qtr = $row['quarter'];
	$yl = $row['year_level'];
}

$query = "SELECT * FROM Subject WHERE subjectID = '$subjectID'";

$result = mysqli_query($dbc, $query) or die("Bad S query");

while($row = mysqli_fetch_assoc($result)) {
	$title = $row['title'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Search</title>

    <!-- CSS -->
    <link rel="stylesheet" href="editclass.css">
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
		<form action="classedited.php" method="post">
			<h1> Class Information <h1>
			<div class="group">
				<label for = "section">Section</label><br>
				<input type="text" name="section" value="<?php echo $section; ?>" disabled>
			</div>
			<div class="group">
				<label for = "school_year">School Year</label><br>
				<input type="text" name="school_year" value="<?php echo $sy; ?>">
			</div>
			<div class="group">
				<label for = "quarter">Quarter</label><br>
				<input type="text" name="quarter" value="<?php echo $qtr; ?>">
			</div>
			<div class="group">
				<label for = "year_level">Year Level</label><br>
				<input type="text" name="year_level" value="<?php echo $yl; ?>">
			</div>
			<h1> Subject Information <h1>
			<div class="group">
				<label for = "subject">Subject</label><br>
				<input type="text" name="subject" value="<?php echo $subjectID; ?>" disabled>
			</div>
			<div class="group">
				<label for = "title">Title</label><br>
				<input type="text" name="title" value="<?php echo $title; ?>">
			</div>
			<h1> Criteria Information <h1>
			<div class="group">
				<label for = "s_type">Type</label><br>
				<input type="text" name="s_type" value="<?php echo $type[0]; ?>" disabled>
			</div>
			<div class="group">
				<label for = "s_reqs">Reqs</label><br>
				<input type="text" name="s_reqs" value="<?php echo $reqs[0]; ?>">
			</div>
			<div class="group">
				<label for = "s_weight">Weight</label><br>
				<input type="text" name="s_weight" value="<?php echo $weight[0]; ?>">
			</div>
			<br>
			<div class="group">
				<label for = "q_type">Type</label><br>
				<input type="text" name="q_type" value="<?php echo $type[1]; ?>" disabled>
			</div>
			<div class="group">
				<label for = "q_reqs">Reqs</label><br>
				<input type="text" name="q_reqs" value="<?php echo $reqs[1]; ?>">
			</div>
			<div class="group">
				<label for = "q_weight">Weight</label><br>
				<input type="text" name="q_weight" value="<?php echo $weight[1]; ?>">
			</div>
			<br>
			<div class="group">
				<label for = "e_type">Type</label><br>
				<input type="text" name="e_type" value="<?php echo $type[2]; ?>" disabled>
			</div>
			<div class="group">
				<label for = "e_reqs">Reqs</label><br>
				<input type="text" name="e_reqs" value="<?php echo $reqs[2]; ?>">
			</div>
			<div class="group">
				<label for = "e_weight">Weight</label><br>
				<input type="text" name="e_weight" value="<?php echo $weight[2]; ?>">
			</div>
        	<input type="submit" name="submit" value="Edit">
		</form>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </body>
</html>