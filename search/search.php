<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Search</title>

    <!-- CSS -->
    <link rel="stylesheet" href="search.css?version=1">
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
      <form action="search.php" method="post">

        <div id="filters">
          <div id = "first">
              <input type="text" name="id" value="" placeholder="ID Number">
              <input type="text" name="firstname" value="" placeholder="First Name">
              <input type="text" name="middleinitial" value="" placeholder="Middle Initial">
              <input type="text" name="lastname" value="" placeholder="Last Name">
              <input type="text" name="sex" value="" placeholder="Sex (M, F)">
              <input type="text" name="dateofbirth" value="" placeholder="Date of Birth (YYYY-MM-DD)">
              <input type="text" name="age" value="" placeholder="Age">
              <input type="text" name="placeofbirth" value="" placeholder="Place of Birth">
              <input type="text" name="address" value="" placeholder="Address">



          </div>

          <div id="second">

            <input type="text" name="phonenumber" value="" placeholder="Phone Number">
            <input type="text" name="studenttype" value="" placeholder="Student Type (Graduate, Undergraduate)">
            <input type="text" name="yearst" value="" placeholder="Year Started">
            <input type="text" name="gradest" value="" placeholder="Grade Started">
            <input type="text" name="yeardr" value="" placeholder="Year Dropped Out">
            <input type="text" name="yearex" value="" placeholder="Year Expelled">
            <input type="text" name="yeargr" value="" placeholder="Year Graduated">
            <input type="text" name="schoolt" value="" placeholder="School To">
            <input type="text" name="schoolf" value="" placeholder="School From">


          </div>
          <input type="submit" name="submit">
        </div>
      </form>

      </div>

    <?php

    if(isset($_POST["submit"])) {
        require '../assets/connect.php';

        function search() {
        @$id = $_POST['id'];
        @$fname = $_POST['firstname'];
        @$lname = $_POST['lastname'];
        @$mname = $_POST['middleinitial'];
        @$address = $_POST['address'];
        @$birthdate = $_POST['dateofbirth'];
        @$age = $_POST['age'];
        @$birthplace = $_POST['placeofbirth'];
        @$phonenumber = $_POST['phonenumber'];
        @$studenttype = $_POST['studenttype'];
        @$sex = $_POST['sex'];
        @$yearstarted = $_POST['yearst'];
        @$gradestarted = $_POST['gradest'];
        @$yearexpelled = $_POST['yearex'];
        @$yeardropped = $_POST['yeardr'];
        @$yeargraduated = $_POST['yeargr'];
        @$schoolfrom = $_POST['schoolf'];
        @$schoolto = $_POST['schoolt'];




        $query = "SELECT * FROM student";
        $conditions = array();

        if(! empty($id)) {
          $conditions[] = "studentID='$id'";
        }
        if(! empty($fname)) {
          $conditions[] = "first_name='$fname'";
        }
        if(! empty($lname)) {
          $conditions[] = "last_name='$lname'";
        }
        if(! empty($mname)) {
          $conditions[] = "middle_initial='$mname'";
        }
        if(! empty($address)) {
          $conditions[] = "address='$address'";
        }
        if(! empty($birthdate)) {
            $conditions[] = "birthdate='$birthdate'";
          }
        if (! empty($age)) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) ='$age'";
        }
        if(! empty($birthplace)) {
            $conditions[] = "birthplace='$birthplace'";
          }
        if(! empty($phonenumber)) {
            $conditions[] = "phone_number='$phonenumber'";
          }
        if(! empty($studenttype)) {
            $conditions[] = "student_type='$studenttype'";
          }
        if(! empty($sex)) {
            $conditions[] = "sex='$sex'";
          }
        if(! empty($yearstarted)) {
            $conditions[] = "year_started='$yearstarted'";
          }
        if(! empty($gradestarted)) {
            $conditions[] = "grade_started='$gradestarted'";
          }
        if(! empty($yearexpelled)) {
            $conditions[] = "year_expelled='$yearexpelled'";
          }
        if(! empty($yeardropped)) {
            $conditions[] = "year_droppedout='$yeardropped'";
          }
        if(! empty($yeargraduated)) {
            $conditions[] = "year_graduated='$yeargraduated'";
          }
        if(! empty($schoolfrom)) {
            $conditions[] = "school_from='$schoolfrom'";
          }
        if(! empty($schoolto)) {
            $conditions[] = "school_to='$schoolto'";
          }

        $sql = $query;
        if (count($conditions) > 0) {
          $sql .= " WHERE " . implode(' AND ', $conditions);
        }



          return $sql;
        }



        $query = search();

        $result = mysqli_query($dbc, $query) or die("Bad S query");

        //print table
        echo"<div id='wrapper'><table name='data'>";
        echo"<tr><td>StudentID</td><td>First Name</td><td>Last Name</td></tr>";
        while($row = mysqli_fetch_assoc($result)){ //fetch_all, fetch_array
          echo"<tr><td>{$row['studentID']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td>
          <td><a href=../info/info.php?ID={$row['studentID']}>View</a></td><td><a href=../edit/editdata.php?ID={$row['studentID']}>Edit</a></td>
          <td><a href=deletestudent.php?ID={$row['studentID']}>Delete</a></td></tr>";
        }
        echo "</table></div>";
    }
?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  </body>
</html>
