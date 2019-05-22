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

    <link rel="stylesheet" href="classedited.css?version=1">
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
		
	if(empty($_POST["school_year"])){
		//Adds name to array
		$sy = 1819;

	} else {
		// Trim white space from the name and store the name
		$sy = trim($_POST["school_year"]);
	}
	
	if(empty($_POST["year_level"])){
		//Adds name to array
		$yl = 10;

	} else {
		// Trim white space from the name and store the name
		$yl = trim($_POST["year_level"]);
	}

	if(empty($_POST["quarter"])){
		//Adds name to array
		$qtr = 1;

	} else {
		// Trim white space from the name and store the name
		$qtr = trim($_POST["quarter"]);
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

		$cid = $_SESSION['cid'];

		$query = "UPDATE Class SET school_year='$sy', quarter='$qtr' WHERE year_level='$yl'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$subject = $_SESSION['subject'];

		$query = "UPDATE Subject SET title='$title' WHERE subjectID='$subject'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);
		
		$query = "UPDATE Criteria SET number_of_requirements='$s_reqs', weight='$s_weight' WHERE criteriaID='$cid[0]'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$query = "DELETE FROM Requirement WHERE criteriaID='$cid[0]' AND requirement_number > '$s_reqs'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$query = "UPDATE Criteria SET number_of_requirements='$q_reqs', weight='$q_weight' WHERE criteriaID='$cid[1]'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$query = "DELETE FROM Requirement WHERE criteriaID='$cid[1]' AND requirement_number > '$q_reqs'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$query = "UPDATE Criteria SET number_of_requirements='$e_reqs', weight='$e_weight' WHERE criteriaID='$cid[2]'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$query = "DELETE FROM Requirement WHERE criteriaID='$cid[2]' AND requirement_number > '$e_reqs'";
		$stmt = mysqli_prepare($dbc, $query);
		mysqli_stmt_execute($stmt);

		$oldreqs = $_SESSION['reqs'];

		if($oldreqs[0] < $s_reqs) {
			for($c = 0; $c < $s_reqs-$oldreqs[0]; $c++) {
				$rn = $oldreqs[0] + $c + 1;
				$query = "INSERT INTO Requirement VALUES (NULL, ?, 0, ?)";
				$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ii",  $rn, $cid[0]);
        mysqli_stmt_execute($stmt);
			}
		}

		if($oldreqs[1] < $q_reqs) {
			for($c = 0; $c < $q_reqs-$oldreqs[1]; $c++) {
				$rn = $oldreqs[1] + $c + 1;
				$query = "INSERT INTO Requirement VALUES (NULL, ?, 0, ?)";
				$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ii",  $rn, $cid[1]);
        mysqli_stmt_execute($stmt);
			}
		}

		if($oldreqs[2] < $e_reqs) {
			for($c = 1; $c < $e_reqs-$oldreqs[2]; $c++) {
				$rn = $oldreqs[2] + $c + 1;
				$query = "INSERT INTO Requirement VALUES (NULL, ?, 0, ?)";
				$stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ii",  $rn, $cid[2]);
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