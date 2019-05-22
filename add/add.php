<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>

    <!-- CSS -->
    <link rel="stylesheet" href="add.css">
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

      <form action="studentadded.php" method="post">
        <h1>Student Information</h1>

				<div class="group">
					<label for ="section">Section</label><br>
					<input type="text" name="section" value="">
				</div>
				<div class="group">
					<label for ="firstname">First Name</label><br>
					<input type="text" name="firstname" value="">
				</div>
				<div class="group">
					<label for ="middleinitial">M.I.</label><br>
					<input type="text" name="middleinitial" value="">
				</div>
				<div class="group">
					<label for ="lastname">Last Name</label><br>
					<input type="text" name="lastname" value="">
				</div>
				<div class="group">
					<label for ="sex">Sex (M, F)</label><br>
					<input type="text" name="sex" value="">
				</div>
        <div class="group">
        	  <label for ="dateofbirth">Birthdate (YYYY-MM-DD)</label><br>
						<input type="text" name="dateofbirth" value="">
        </div>
				<div class="group">
					<label for ="placeofbirth">Birthplace</label><br>
					<input type="text" name="placeofbirth" value="">
				</div>
				<div class="group">
					<label for ="phonenumber">Phone Number</label><br>
					<input type="text" name="phonenumber" value="">
				</div>
				<div class="group">
					<label for ="address">Address</label><br>
					<input type="text" name="address" value="">
				</div>
				<div class="group">
					<label for ="studenttype">Student Type (Graduate, Undergraduate)</label><br>
					<input type="text" name="studenttype" value="">
				</div>
				<div class="group">
					<label for ="yearst">Year Started</label><br>
					<input type="text" name="yearst" value="">
				</div>
				<div class="group">
					<label for ="gradest">Grade Started</label><br>
					<input type="text" name="gradest" value="">
				</div>
				<div class="group">
					<label for ="yearex">Year Expelled</label><br>
					<input type="text" name="yearex" value="0000">
				</div>
				<div class="group">
					<label for ="yeardr">Year Dropped Out</label><br>
					<input type="text" name="yeardr" value="0000">
				</div>
				<div class="group">
					<label for ="yeargr">Year Graduated</label><br>
					<input type="text" name="yeargr" value="0000">
				</div>
				<div class="group">
					<label for ="schoolf">School From</label><br>
					<input type="text" name="schoolf" value="">
				</div>
				<div class="group">
					<label for ="schoolt">School To</label><br>
					<input type="text" name="schoolt" value="">
				</div>

        <h1>Parent/Guardian Information</h1>
        <div class="group">
					<label for ="pgfirstname">First Name</label><br>
					<input type="text" name="pgfirstname" value="">
				</div>
				<div class="group">
  				<label for ="pglastname">Last Name</label><br>
					<input type="text" name="pglastname" value="">
				</div>
				<div class="group">
					<label for ="pgaddress"> Address</label><br>
					<input type="text" name="pgaddress" value="">
				</div>

        <h1>Emergency Contact Information</h1>
        <div class="group">
					<label for ="efirstname">First Name</label><br>
					<input type="text" name="efirstname" value="">
				</div>
				<div class="group">
					<label for ="elastname">Last Name</label><br>
					<input type="text" name="elastname" value="">
				</div>
				<div class="group">
					<label for ="ephonenumber">Phone Number</label><br>
					<input type="text" name="ephonenumber" value="">
				</div>
				<div class="group">
					  <label for ="eaddress">Address</label><br>
						<input type="text" name="eaddress" value="">
				</div>
        <br>
        <input type="submit" name="submit" value="Confirm">
      </form>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>
