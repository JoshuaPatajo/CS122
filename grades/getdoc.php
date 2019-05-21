<?php

$years = array();
$subj = array("Filipino", "English", "Mathematics", "Science", "Araling Panlipunan (AP)", "Edukasyon sa Pagpapakatao", "Technology and Livelihood Education (TLE)", "MAPEH", "Music","Art","Physical Education","Health");
$c = 0;
if(isset($_GET['ID'])){
require_once '../assets/connect.php';
require_once '../assets/vendor/autoload.php';

$template = new \PhpOffice\PhpWord\TemplateProcessor('Form138.docx');

$ID = mysqli_real_escape_string($dbc, $_GET['ID']);
$year = mysqli_real_escape_string($dbc, $_GET['year']);

//get student info
$query = "SELECT studentID, firstname, middlename, lastname, sex, birthdate FROM student WHERE studentID='$ID'";
$result = mysqli_query($dbc, $query) or die("ERROR obtaining data");
$row = mysqli_fetch_array($result);

$firstname = $row['firstname'];
$middleinitial = $row['middlename'];
$lastname = $row['lastname'];

$template->setValue("firstname", $firstname);
$template->setValue("middleinitial", $middleinitial);
$template->setValue("lastname", $lastname);
//$template->setValue("age", $row['age']);
$template->setValue("sex", $row['sex']);
$template->setValue("lrn", $row['studentID']);

//date in mm/dd/yyyy format; or it can be in other formats as well
$birthDate = $row['birthdate'];
//explode the date to get month, day and year
$birthDate = explode("-", $birthDate);
//get age from date or birthdate
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
  ? ((date("Y") - $birthDate[0]) - 1)
  : (date("Y") - $birthDate[0]));
$template->setValue("age", $age);

//count amount of report card forms needed
$query = "SELECT count( DISTINCT(schoolyear) ) AS 'count' FROM grades WHERE studentID='$ID'";
$result = mysqli_query($dbc, $query) or die("ERROR counting years");
$row = mysqli_fetch_array($result);
$yearcount = $row['count'];

//store distinct schoolyears in an array
$query = "SELECT DISTINCT schoolyear FROM grades WHERE studentID='$ID'";
$result = mysqli_query($dbc, $query) or die("ERROR obtaining schoolyear");
while($row = mysqli_fetch_assoc($result)){
$years[] = $row['schoolyear'];
}
}else{
header("Location: viewgrades.php");
}

$template->setValue("grade", $year);

$currentyear = $years[$year - 1];
$template->setValue("schoolyear", $currentyear);
// section
$query = "SELECT DISTINCT section FROM section WHERE studentID='$ID' AND schoolyear='$currentyear'";
$result = mysqli_query($dbc, $query) or die("ERROR getting section");
$row = mysqli_fetch_array($result);
$template->setValue("section", $row['section']);

//teacher
$query = "SELECT DISTINCT name FROM adviser WHERE studentID='$ID' AND schoolyear='$currentyear'";
$result = mysqli_query($dbc, $query) or die("ERROR getting adviser");
$row = mysqli_fetch_array($result);
$template->setValue("teacher", $row['name']);

$ga = 0;
$index = $year - 1;
//count amount of quarters the student has grades for
$query = "SELECT MAX(quarter) AS quarter FROM grades WHERE studentID='$ID' AND schoolyear='$years[$index]'";
$result = mysqli_query($dbc, $query) or die("ERROR counting quarter");
$row = mysqli_fetch_array($result);
$qtrcount = $row['quarter'];

$filename = "$lastname $firstname $middleinitial Year: $currentyear";

for($j = 0; $j < 12; $j++){
  $tmp = $j+1;
  $total = 0;

  //grabbing grades by subject so max 4 entries here (1,2,3,4 qtr)

  $query = "SELECT grade FROM subject, grades, student
  WHERE student.studentID=grades.studentID AND grades.studentID ='$ID' AND grades.subjectcode = subject.subjectcode AND grades.subjectcode='$tmp' AND grades.schoolyear='$years[$index]' ORDER BY quarter LIMIT 4";
  $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));

  $variablename = "_$j";
  $finalremark = 0;
  if($qtrcount == 4) {
    $finalremark = 1;
  }
  $colnum = 0;

  while($row = mysqli_fetch_array($result)){
    $template->setValue($variablename . $colnum, $row['grade']);
    $total += $row['grade'];
    $colnum++;
  }

  for($k = 0; $k < 4-$qtrcount; $k++){
    $template->setValue($variablename . $colnum, "");
    $colnum++;
  }

  if($finalremark == 1){
    $finalgrade = $total/4;
    $ga += $finalgrade;
    $template->setValue($variablename . "fg", $finalgrade);
    if($finalgrade >= 75){
      $template->setValue($variablename . "rem", "PASSED");
    }else{
      $template->setValue($variablename . "rem", "FAILED");
    }
  }else{
    $template->setValue($variablename . "fg", "");
    $template->setValue($variablename . "rem", "");
  }



}

$fga = $ga/12;
if ($ga != 0) {
    $template->setValue("ga", number_format($fga, 2));
}
else {
  $template->setValue("ga", "");
}

$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
$template->saveAs($temp_file);


header("Content-Disposition: attachment; filename='$filename.docx'");
readfile($temp_file); // or echo file_get_contents($temp_file);
unlink($temp_file);
?>
