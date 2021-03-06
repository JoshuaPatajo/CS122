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
    <title>Student Added</title>

    <link rel="stylesheet" href="studentadded.css?version=1">
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

    <?php

if(isset($_POST['submit'])){
    $data_missing = array();
	   $out = "";
	if(empty($_POST["firstname"])){
        //Adds name to array
        $data_missing[] = "Student First Name ";

    } else {
        // Trim white space from the name and store the name
        $s_fname = trim($_POST["firstname"]);
    }

	if(empty($_POST["lastname"])){
        //Adds name to array
        $data_missing[] = "Student Last Name ";

    } else {
        // Trim white space from the name and store the name
        $s_lname = trim($_POST["lastname"]);
    }

	if(empty($_POST["middleinitial"])){
        // Sets optional value to null
        $s_mname = NULL;

    } else {
        // Trim white space from the name and store the name
        $s_mname = trim($_POST["middleinitial"]);
    }

	if(empty($_POST["address"])){

        $s_address = NULL;

    } else {
        // Trim white space from the name and store the name
        $s_address = trim($_POST["address"]);
    }
	if(empty($_POST["dateofbirth"])){
        
        $birthdate = NULL;

    } else {
        // Trim white space from the name and store the name
        $birthdate = trim($_POST["dateofbirth"]);
    }
	if(empty($_POST["placeofbirth"])){
        
        $birthplace = NULL;

    } else {
        // Trim white space from the name and store the name
        $birthplace = trim($_POST["placeofbirth"]);
    }


	if(empty($_POST["phonenumber"])){
        
        $s_phonenumber = NULL;

    } else {
        // Trim white space from the name and store the name
        $s_phonenumber = trim($_POST["phonenumber"]);
    }

	if(empty($_POST["studenttype"])){
        
        $s_type = NULL;

    } else {
        // Trim white space from the name and store the name
        $s_type = trim($_POST["studenttype"]);
    }

	if(empty($_POST["sex"])){
        
        $sex = NULL;

    } else {
        // Trim white space from the name and store the name
        $sex = trim($_POST["sex"]);
    }
	if(empty($_POST["yearst"])){
        
        $yearstarted = NULL;

    } else {
        // Trim white space from the name and store the name
        $yearstarted = trim($_POST["yearst"]);
    }
	if(empty($_POST["gradest"])){
        
        $gradestarted = NULL;

    } else {
        // Trim white space from the name and store the name
        $gradestarted = trim($_POST["gradest"]);
    }
	if(empty($_POST["yearex"])){
        
        $yearexpelled = NULL;

    } else {
        // Trim white space from the name and store the name
        $yearexpelled = trim($_POST["yearex"]);
    }

	if(empty($_POST["yeardr"])){
        
        $yeardropped = NULL;

    } else {
        // Trim white space from the name and store the name
        $yeardropped = trim($_POST["yeardr"]);
    }

	if(empty($_POST["yeargr"])){
        
        $yeargraduated = NULL;

    } else {
        // Trim white space from the name and store the name
        $yeargraduated = trim($_POST["yeargr"]);
    }

	if(empty($_POST["schoolf"])){
        
        $schoolfrom = NULL;

    } else {
        // Trim white space from the name and store the name
        $schoolfrom = trim($_POST["schoolf"]);
    }

	if(empty($_POST["schoolt"])){
        
        $schoolto = NULL;

    } else {
        // Trim white space from the name and store the name
        $schoolto = trim($_POST["schoolt"])."";
    }

	if(empty($_POST["pgfirstname"])){
        
        $p_fname = NULL;

    } else {
        // Trim white space from the name and store the name
        $p_fname = trim($_POST["pgfirstname"])."";
    }

	if(empty($_POST["pglastname"])){
        
        $p_lname = NULL;

    } else {
        // Trim white space from the name and store the name
        $p_lname = trim($_POST["pglastname"])."";
    }

	if(empty($_POST["pgaddress"])){
        
        $p_address = NULL;

    } else {
        // Trim white space from the name and store the name
        $p_address = trim($_POST["pgaddress"])."";
    }

	if(empty($_POST["efirstname"])){
        
        $e_fname = NULL;

    } else {
        // Trim white space from the name and store the name
        $e_fname = trim($_POST["efirstname"])."";
    }

	if(empty($_POST["elastname"])){
        
        $e_lname = NULL;

    } else {
        // Trim white space from the name and store the name
        $e_lname = trim($_POST["elastname"])."";
    }

	if(empty($_POST["eaddress"])){
        
        $e_address = NULL;

    } else {
        // Trim white space from the name and store the name
        $e_address = trim($_POST["eaddress"])."";
    }

	if(empty($_POST["ephonenumber"])){
        
        $e_phonenumber = NULL;

    } else {
        // Trim white space from the name and store the name
        $e_phonenumber = trim($_POST["ephonenumber"])."";
    }

    ?>

    <div id="header"><img src="../assets/ths.png" alt=""> T.I.S.I.S</div>
    <div id="container">
      <?php

      require '../assets/connect.php';
      $section = trim($_POST["section"])."";
      $inClass = false;
      $query = "SELECT section FROM Grading_Period WHERE teacherID = '$teacherID'";
      $result = mysqli_query($dbc, $query) or die("Bad a query");

      while($row = mysqli_fetch_assoc($result)) {
          if($section == $row['section']) {
              $inClass = true;
              break;
          }
      }

      if(empty($data_missing) && $inClass){

		//inserting the student
        $query = "INSERT INTO Student (studentID, first_name, middle_initial, last_name, sex, birthdate, birthplace, phone_number,
        address, student_type, year_started, grade_started, year_expelled, year_dropped, year_graduated, school_from, school_to,
        guardian_first_name, guardian_last_name, guardian_address, emergency_first_name, emergency_last_name,
        emergency_phone_number, emergency_address) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = mysqli_prepare($dbc, $query);

        mysqli_stmt_bind_param($stmt, "ssssssssssissssssssssss",  $s_fname, $s_mname, $s_lname, $sex, $birthdate, $birthplace, $s_phonenumber,
        $s_address, $s_type, $yearstarted, $gradestarted, $yearexpelled, $yeardropped, $yeargraduated, $schoolfrom, $schoolto,
        $p_fname, $p_lname, $p_address, $e_fname, $e_lname, $e_phonenumber, $e_address);

        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1) {
            echo "<i class='fas fa-user'></i><br>
            Student has been successfully added!<br>
            <a href='add.php'><button type='button' name='button'>Add Another Student</button></a>
            <a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";

            $query = "SELECT studentID FROM Student ORDER BY studentID DESC LIMIT 1";
            $result = mysqli_query($dbc, $query) or die();
            $row = mysqli_fetch_array($result);

            $studentID = $row['studentID'];
            $query = "INSERT INTO Class_Student VALUES (?, ?)";

            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, "si",  $section, $studentID);
            mysqli_stmt_execute($stmt);

            $query = "SELECT subjectID FROM Grading_Period WHERE section = '$section' AND teacherID = '$teacherID'";
		    $result = mysqli_query($dbc, $query) or die("Bad a query");

            while($row = mysqli_fetch_assoc($result)) {
                $sid = $row['subjectID'];
                $query = "SELECT criteriaID FROM Criteria WHERE subjectID = '$sid'";
                $res = mysqli_query($dbc, $query) or die();

                $query = "INSERT INTO Grading_Period VALUES (?, ?, ?, ?)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "sisi",  $section, $studentID, $sid, $teacherID);
				mysqli_stmt_execute($stmt);

                while($r = mysqli_fetch_assoc($res)) {
                    $cid = $r['criteriaID'];
                    $query = "SELECT requirementID FROM Requirement WHERE criteriaID = $cid";
                    $ser = mysqli_query($dbc, $query) or die();

                    while($wor = mysqli_fetch_assoc($ser)) {
                        $rid = $wor['requirementID'];
                        $query = "INSERT INTO Student_Grade VALUES (?, ?, 0)";
				        $stmt = mysqli_prepare($dbc, $query);
				        mysqli_stmt_bind_param($stmt, "ii",  $studentID, $rid);
				        mysqli_stmt_execute($stmt);
                    }
                }
            }

            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
        else {
            echo 'Error Occured <br />';
            echo mysqli_error();

            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    } else if (!$inClass) {
        echo "Student is not in a Class you handle<br>
        <a href='add.php'><button type='button' name='button'>Add Another Student</button></a>
        <a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";
    }
    else {

        echo 'You need to enter the following data<br />';

        foreach($data_missing as $missing){

            echo "$missing<br />";

        }

        mysqli_stmt_close($stmt);
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
