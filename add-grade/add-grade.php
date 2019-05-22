<?php
session_start();

$teacherID = $_SESSION['teacherID'];

require_once '../assets/connect.php';

$subject = array();
$section = array();

$query = "SELECT Subject.subjectID, Grading_Period.section FROM Subject, Grading_Period WHERE Grading_Period.subjectID=Subject.subjectID AND Grading_Period.teacherID='$teacherID'";
$result = $dbc->query($query);
if ($result->num_rows > 0) {
	// output data of each row
    while($row = $result->fetch_assoc()) {
		$subject[] = $row["subjectID"];
		$section[] = $row["section"];
	}
} else {
    echo "0 results";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>

    <!-- CSS -->
    <link rel="stylesheet" href="add-grade.css">
    <link rel="stylesheet" href="..\assets\header.css">
    <link rel="stylesheet" href="..\assets\scrollbar.css">
    <link rel="stylesheet" href="..\assets\back.css">
    <link href="../assets/Hover-master/css/hover.css" rel="stylesheet" media="all">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->


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

      <form action="add-grade.php" method="post">
	  	<select name="subject">
		  <?php
		  for($c = 0; $c < count($section); $c++) {
			$value = $subject[$c] . " " . $section[$c];
			echo "<option value='" . $value . "'>" . $subject[$c] . " - " . $section[$c] . "<option>"; 
		  }
          ?>
        </select>
        <input type="submit" name="submit" value="Confirm">
      </form>

	</div>
	
	<?php
	if(isset($_POST["submit"])) {

		require_once '../assets/connect.php';

		$param = trim($_POST["subject"])."";
		$params = explode(" ", $param);

		echo "<h1>$params[0]<h1>";

		$query = "SELECT std.studentID, std.first_name, std.last_name FROM Student AS std, 
		Grading_Period AS gp WHERE gp.studentID = std.studentID AND gp.teacherID = '$teacherID' AND 
		gp.subjectID = '$params[0]' AND gp.section = '$params[1]'";

        $result = mysqli_query($dbc, $query) or die("Bad S query");

		echo"<div id='wrapper'><table name='data'>";
        echo"<tr><td>StudentID</td><td>First Name</td><td>Last Name</td></tr>";
        while($row = mysqli_fetch_assoc($result)){ //fetch_all, fetch_array
          echo"<tr><td>{$row['studentID']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td>
		  <td><a href=../grades/viewgrades.php?ID={$row['studentID']}&subjectID={$params[0]}&section={$params[1]}>View</a></td>
		  <td><a href=../grades/editgrades.php?ID={$row['studentID']}&subjectID={$params[0]}&section={$params[1]}>Edit</a></td></tr>";
        }
        echo "</table></div>";
	}
	?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>