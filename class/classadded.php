<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Edited</title>

    <link rel="stylesheet" href="classadded.css?version=1">
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
  if(isset($_POST['submit'])) {

    $data_missing = array();
	$out = "";
	
	if(empty($_POST["subject"])){
		//Adds name to array
		$data_missing[] = "subject";

	} else {
		$subject = trim($_POST["subject"]);
	}

	if(empty($_POST["section"])){
		//Adds name to array
		$data_missing[] = "section";

	} else {
		// Trim white space from the name and store the name
		$section = trim($_POST["section"]);
	}

	if(empty($_POST["title"])){
		//Adds name to array
		$title = "Wumbology";

	} else {
		// Trim white space from the name and store the name
		$title = trim($_POST["title"]);
	}
	  
	if(empty($_POST["s_reqs"])){
		//Adds name to array
		$s_reqs = 0;

	} else {
		// Trim white space from the name and store the name
		$s_reqs = trim($_POST["s_reqs"]);
	}
	
	if(empty($_POST["s_weight"])){
		//Adds name to array
		$s_weight = 0;

	} else {
		// Trim white space from the name and store the name
		$s_weight = trim($_POST["s_weight"]);
	}
	  
	if(empty($_POST["q_reqs"])){
		//Adds name to array
		$q_reqs = 0;

	} else {
		// Trim white space from the name and store the name
		$q_reqs = trim($_POST["q_reqs"]);
	}
	
	if(empty($_POST["q_weight"])){
		//Adds name to array
		$q_weight = 0;

	} else {
		// Trim white space from the name and store the name
		$q_weight = trim($_POST["q_weight"]);
	}
	  
	if(empty($_POST["e_reqs"])){
		//Adds name to array
		$e_reqs = 0;

	} else {
		// Trim white space from the name and store the name
		$e_reqs = trim($_POST["e_reqs"]);
	}
	
	if(empty($_POST["e_weight"])){
		//Adds name to array
		$e_weight = 0;
		
	} else {
		// Trim white space from the name and store the name
		$e_weight = trim($_POST["e_weight"]);
  	}
    
    if(empty($data_missing)){
  
		require '../assets/connect.php';
		
		$query = "INSERT INTO Subject VALUES (?, ?)";
		$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ss",  $subject, $title);
		mysqli_stmt_execute($stmt);
		
		$query = "INSERT INTO Criteria VALUES (NULL, 'Seatwork', ?, ?, ?)";
		$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "iis",  $s_reqs, $s_weight, $subject);
		mysqli_stmt_execute($stmt);
		
		$query = "INSERT INTO Criteria VALUES (NULL, 'Quizzes', ?, ?, ?)";
		$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "iis",  $q_reqs, $q_weight, $subject);
		mysqli_stmt_execute($stmt);
		
		$query = "INSERT INTO Criteria VALUES (NULL, 'Exams', ?, ?, ?)";
		$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "iis",  $e_reqs, $e_weight, $subject);
		mysqli_stmt_execute($stmt);

		$query = "SELECT criteriaID FROM Criteria ORDER BY criteriaID DESC LIMIT 3";
		$result = mysqli_query($dbc, $query) or die("Bad a query");

		$reqs = array();
		$reqs[] = $s_reqs;
		$reqs[] = $q_reqs;
		$reqs[] = $e_reqs;

		$reqCount = 0;
		$num = 0;

		while($row = mysqli_fetch_assoc($result)) {
			if($reqs[$num] > 0) {
				for($c = 1; $c <= $reqs[$num]; $c++) {
					$query = "INSERT INTO Requirement VALUES (NULL, ?, 0, ?)";
					$stmt = mysqli_prepare($dbc, $query);
					mysqli_stmt_bind_param($stmt, "ii",  $c, $row['criteriaID']);
					mysqli_stmt_execute($stmt);
					$reqCount++;
				}
			}
			$num++;
		}	
		$teacherID = $_SESSION['teacherID'];
		$query = "SELECT DISTINCT studentID FROM Grading_Period WHERE teacherID = '$teacherID'";
		$result = mysqli_query($dbc, $query) or die("Bad b query");

		while($row = mysqli_fetch_assoc($result)) {
			$query = "INSERT INTO Grading_Period VALUES (?, ?, ?, ?)";
			$stmt = mysqli_prepare($dbc, $query);
			mysqli_stmt_bind_param($stmt, "sisi",  $section, $row['studentID'], $subject, $teacherID);
			mysqli_stmt_execute($stmt);

			$query = "SELECT requirementID FROM Requirement ORDER BY requirementID DESC LIMIT $reqCount";
			$res = mysqli_query($dbc, $query) or die("Bad c query");

			while($r = mysqli_fetch_assoc($res)) {
				$query = "INSERT INTO Student_Grade VALUES (?, ?, 0)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ii",  $row['studentID'], $r['requirementID']);
				mysqli_stmt_execute($stmt);
			}
		}	

		echo "<i class='fas fa-user'></i><br>
		Class has been successfully edited!<br>
		<a href='class.php'><button type='button' name='button'>View Classes</button></a>
		<a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";

			mysqli_close($dbc);
      }
    }

?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
      <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>