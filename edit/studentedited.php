<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Edited</title>

    <link rel="stylesheet" href="studentedited.css?version=1">
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

    $id = $_POST["studentID"];

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
    
    if(empty($data_missing)){
  
          require '../assets/connect.php';
  
      //inserting the student
          $query = "UPDATE Student SET first_name='$s_fname', middle_initial='$s_mname', last_name='$s_lname'
      WHERE studentID='$id'";
  
      // $stmt = mysqli_prepare($dbc, $query);
  
      //     mysqli_stmt_execute($stmt);
          
      //     $affected_rows = mysqli_stmt_affected_rows($query);
  
          if(mysqli_query($dbc, $query)) {
              echo "<i class='fas fa-user'></i><br>
              Student has been successfully edited!<br>
              <a href='editsearch.php'><button type='button' name='button'>Edit More Students</button></a>
              <a href='../menu/menu.php'><button type='button' name='button'>Back to Menu</button></a>";
  
              mysqli_close($dbc);
          }
          else {
              echo 'Error Occured <br />';
              echo mysqli_error();
  
              mysqli_stmt_close($stmt);
              mysqli_close($dbc);
          }
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
