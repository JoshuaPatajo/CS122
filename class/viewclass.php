<?php
session_start();

$teacherID = $_SESSION['teacherID'];
$subjectID = $_GET['subject'];
$section = $_GET['section'];

require_once '../assets/connect.php';

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
    <link rel="stylesheet" href="viewclass.css">
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
		<form>
		<h1> Class Information <h1>
			<div class="group">
				<label for = "section">Section</label><br>
				<input type="text" name="section" value="<?php echo $section; ?>" disabled>
			</div>
			<div class="group">
				<label for = "school_year">School Year</label><br>
				<input type="text" name="school_year" value="<?php echo $sy; ?>" disabled>
			</div>
			<div class="group">
				<label for = "quarter">Quarter</label><br>
				<input type="text" name="quarter" value="<?php echo $qtr; ?>" disabled>
			</div>
			<div class="group">
				<label for = "year_level">Year Level</label><br>
				<input type="text" name="year_level" value="<?php echo $yl; ?>" disabled>
			</div>
			<h1> Subject Information <h1>
			<div class="group">
				<label for = "subject">Subject</label><br>
				<input type="text" name="subject" value="<?php echo $subjectID; ?>" disabled>
			</div>
			<div class="group">
				<label for = "title">Title</label><br>
				<input type="text" name="title" value="<?php echo $title; ?>" disabled>
			</div>
			<h1> Criteria Information <h1>
			<?php

			require_once '../assets/connect.php';

			$query = "SELECT * FROM Criteria WHERE subjectID = '$subjectID'";

			$result = mysqli_query($dbc, $query) or die("Bad S query");

			//print table
			while($row = mysqli_fetch_assoc($result)){ //fetch_all, fetch_array
				echo "<div class='group'>
				<label for = 'type'>Type</label><br>
				<input type='text' name='type' value={$row['type']} disabled>
				</div>";
				echo "<div class='group'>
				<label for = 'reqs'>Reqs</label><br>
				<input type='text' name='reqs' value={$row['number_of_requirements']} disabled>
				</div>";
				echo "<div class='group'>
				<label for = 'weight'>Weight</label><br>
				<input type='text' name='weight' value={$row['weight']} disabled>
				</div> <br>";
			}


			$query = "SELECT std.studentID FROM Student AS std, Grading_Period AS gp WHERE gp.studentID = std.studentID AND 
			gp.section = '$section' AND gp.subjectID = '$subjectID' ORDER BY std.last_name";

			$result = mysqli_query($dbc, $query) or die("Bad a query");

			$cnum = 1;

			$query = "SELECT criteriaID FROM Criteria WHERE subjectID = '$subjectID'";

			$res = mysqli_query($dbc, $query) or die("Bad b query");

			$criteria = array();
			while($row = mysqli_fetch_assoc($res)) {
				$criteria[] = $row["criteriaID"];
			}
			
			echo"<div id='wrapper'><table name='data'>";
			echo"<tr><td>ID </td><td>First Name </td><td>Last Name </td><td>Final Grade</td></tr>";
			while($row = mysqli_fetch_assoc($result)) {
				$stid = $row['studentID'];
				$query = "SELECT studentID, first_name, last_name, (SELECT sum(score) FROM ( SELECT 
				(SELECT sum(sg.score) FROM Student_Grade AS sg, Requirement AS r WHERE sg.requirementID = 
				r.requirementID AND r.criteriaID = '$criteria[0]' AND sg.studentID = '$stid') / 
				(SELECT sum(highest_possible_score) AS HPS FROM Requirement WHERE criteriaID = 
				'$criteria[0]') * weight AS score FROM Criteria WHERE criteriaID='$criteria[0]' 
				UNION ALL SELECT (SELECT sum(sg.score) FROM Student_Grade AS sg, Requirement AS r 
				WHERE sg.requirementID = r.requirementID AND r.criteriaID = '$criteria[1]' AND 
				sg.studentID = '$stid') / (SELECT sum(highest_possible_score) AS HPS FROM Requirement 
				WHERE criteriaID = '$criteria[1]') * weight AS score FROM Criteria WHERE criteriaID='$criteria[1]' 
				UNION ALL SELECT (SELECT sum(sg.score) FROM Student_Grade AS sg, Requirement AS r 
				WHERE sg.requirementID = r.requirementID AND r.criteriaID = '$criteria[2]' AND 
				sg.studentID = '$stid') / (SELECT sum(highest_possible_score) AS HPS FROM Requirement 
				WHERE criteriaID = '$criteria[2]') * weight AS score FROM Criteria WHERE criteriaID='$criteria[2]' ) AS a
				) * 100 AS Score FROM Student WHERE studentID = '$stid';
				";

				$temp = mysqli_query($dbc, $query) or die("Bad c query");

				while($r = mysqli_fetch_assoc($temp)) {
					echo"<tr><td>{$r['studentID']}</td><td>{$r['first_name']}</td><td>{$r['last_name']}</td><td>{$r['Score']}</td></tr>";
				}
			}
			echo "</table></div>";

			?>
		</form>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </body>
</html>