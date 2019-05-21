<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Added</title>

    <link rel="stylesheet" href="studentsadded.css?version=1">
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
//start of the insert to database code
$count = count($tableheadings);
$count = (count($actualdata) +1)/ ($count+1);

require '../assets/connect.php';
$c = 0;

$affected_rows = 0;

//loop thru rows of data
for($i = 0; $i < $count; $i++){

	if(!empty($actualdata[$c]) && !empty($actualdata[$c+2])) {
		$s_fname = $actualdata[$c];
		$s_mname = $actualdata[$c+1];
		$s_lname = $actualdata[$c+2];
		$sex = $actualdata[$c+3];
		$birthdate = $actualdata[$c+4];
		$birthplace = $actualdata[$c+5];
		$s_phonenumber = $actualdata[$c+6];
		$s_address = $actualdata[$c+7];
		$s_type = $actualdata[$c+8];
		$yearstarted = $actualdata[$c+9];
		$gradestarted = $actualdata[$c+10];
		$yearexpelled = $actualdata[$c+11];
		$yeardropped = $actualdata[$c+12];
		$yeargraduated = $actualdata[$c+13];
		$schoolfrom = $actualdata[$c+14];
		$schoolto = $actualdata[$c+15];
		$p_fname = $actualdata[$c+16];
		$p_lname = $actualdata[$c+17];
		$p_address = $actualdata[$c+18];
		$e_fname = $actualdata[$c+19];
		$e_lname = $actualdata[$c+20];
		$e_phonenumber = $actualdata[$c+21];
		$e_address = $actualdata[$c+22];

		//inserting the student
		$query = "INSERT INTO Student (studentID, first_name, middle_initial, last_name, sex, birthdate, birthplace, phone_number,
		address, student_type, year_started, grade_started, year_expelled, year_dropped, year_graduated, school_from, school_to,
		guardian_first_name, guardian_last_name, guardian_address, emergency_first_name, emergency_last_name,
		emergency_phone_number, emergency_address) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = mysqli_prepare($dbc, $query);

		mysqli_stmt_bind_param($stmt, "ssssssssssissssssssssss",  $s_fname, $s_mname, $s_lname, $sex, $birthdate, $birthplace, $s_phonenumber,
		$s_address, $s_type, $yearstarted, $gradestarted, $yearexpelled, $yeardropped, $yeargraduated, $schoolfrom, $schoolto,
		$p_fname, $p_lname, $p_address, $e_fname, $e_lname, $e_phonenumber, $e_address);

		//execute
		mysqli_stmt_execute($stmt) or die(mysqli_error($dbc));

		$affected_rows = mysqli_stmt_affected_rows($stmt);
	}
	$c += count($tableheadings);
}

if($affected_rows >= 1) {
		echo "<i class='fas fa-user'></i><br>
		Students have been successfully added!<br>
		<a href='../addmenu/addmenu.php'><button type='button' name='button'>Add More Students</button></a>
		<a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";

		mysqli_stmt_close($stmt);
		mysqli_close($dbc);
}
else {
		echo 'Error Occured <br />';
		echo mysqli_error();

		mysqli_stmt_close($stmt);
		mysqli_close($dbc);
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
