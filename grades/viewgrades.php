<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grades</title>

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="..\assets\header.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

		<link rel="stylesheet" href="viewgrades.css?version=4">
		<link rel="stylesheet" href="..\assets\scrollbar.css">
  </head>
  <body>
		<div id="header"><img src="../assets/ths.png" alt=""> T.I.S.I.S</div>

<div id="container">
  <?php
$years = array();
$subj = array("Filipino", "English", "Mathematics", "Science", "Araling Panlipunan (AP)", "Edukasyon sa Pagpapakatao", "Technology and Livelihood Education (TLE)", "MAPEH", "Music","Art","Physical Education","Health");
$c = 0;
if(isset($_GET['ID'])){
	require_once '../assets/connect.php';
	$ID = mysqli_real_escape_string($dbc, $_GET['ID']);

	//count amount of report card forms needed
	$query = "SELECT count( DISTINCT(schoolyear) ) AS 'count' FROM grades WHERE studentID='$ID'";
	$result = mysqli_query($dbc, $query) or die("ERROR counting years");
	$row = mysqli_fetch_array($result);
	$yearcount = $row['count'];

	//store distinct schoolyears in an array
	$query = "SELECT DISTINCT schoolyear FROM grades WHERE studentID='$ID'";
	$result = mysqli_query($dbc, $query) or die("ERROR array years");
	while($row = mysqli_fetch_assoc($result)){
	$years[] = $row['schoolyear'];
 }
}else{
	header("Location: viewstudent.php");
}

if($yearcount == 0){
	echo "<div id='none'>No entries found.</div>";
}

for($i = 1; $i <= $yearcount; $i++){

$index = $i - 1;
	//count amount of quarters the student has grades for
	$query = "SELECT MAX(quarter) AS quarter FROM grades WHERE studentID='$ID' AND schoolyear='$years[$index]'";
	$result = mysqli_query($dbc, $query) or die("ERROR counting quarter");
	$row = mysqli_fetch_array($result);
	$qtrcount = $row['quarter'];

	//Creating table of report card

	echo"<table name='main'>";
  echo "<tr><td>" . "Year: $i </td></tr>";
	echo"<tr><td>Learning Areas</td>
	<td><table name='sub' border='1'><tr>Quarter</tr>
	<tr><td>1</td><td>2</td><td>3</td><td>4</td></tr></table>
	<td>Final Grade</td>
	<td>Remarks</td></tr>";

	for($j = 0; $j < 12; $j++){
		$tmp = $j+1;
		$total = 0;

		//grabbing grades by subject so max 4 entries here (1,2,3,4 qtr)
    $index = $i - 1;
		$query = "SELECT grade FROM subject, grades, student
		WHERE student.studentID=grades.studentID AND grades.studentID ='$ID' AND grades.subjectcode = subject.subjectcode AND grades.subjectcode='$tmp' AND grades.schoolyear='$years[$index]' ORDER BY quarter LIMIT 4";
		$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
		echo "<tr><td>{$subj[$c]}</td>";
		echo "<td><table name='sub' border='1'><tr>";
		$finalremark = 0;
		if($qtrcount == 4) {
			$finalremark = 1;
		}
		while($row = mysqli_fetch_array($result)){

			echo "<td name='grade'>{$row['grade']}</td>";
			$total += $row['grade'];
		}

		for($k = 0; $k < 4-$qtrcount; $k++){
			echo "<td></td>";
		}
		echo "</tr></table></td>";

		if($finalremark == 1){
			$finalgrade = $total/4;
			echo "<td>{$finalgrade}</td>"; //final grade
			if($finalgrade >= 75){
			echo "<td>PASSED</td></tr>"; //passed
			}else{
				echo "<td>FAILED</td></tr>"; //passed
			}
		}else{
			echo "<td></td>";
			echo "<td></td></tr>";
		}




		$c++;
	}

	echo "</table>";
	$c = 0;

    echo " <a href=getdoc.php?ID=$ID&year=$i><button type='button' name='printb'>Print Grades</button></a>";

}


?>


<?php
echo "<div id='buttons'>
  <a href=../info/info.php?ID=$ID><button type='button' name='button'>Back to Student</button></a>
  <a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";
echo "</div>";
?>
</div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
  </body>
</html>
