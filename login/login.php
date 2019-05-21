<?php
session_start();
if(isset($_POST['submit'])) {
  require_once '../assets/connect.php';

  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $username = stripcslashes($username);
  $password = stripcslashes($password);

  $query = "SELECT * FROM Teacher WHERE username='$username' AND password='$password'";
  $result = mysqli_query($dbc, $query) or die();
  $row = mysqli_fetch_array($result);

  if ($row['username'] == $username && $row['password'] == $password) {
    // $_SESSION['userdata']['username']=$logins[$username];
    $_SESSION['teacherID'] = $row['teacherID'];
    header("location: ../menu/menu.php");
    exit;
  }
  else {
    $msg="<span style='color:red;'>Invalid Login Details</span>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>

    <!-- CSS -->
    <link rel="stylesheet" href="login.css?version=2">
	<link href="../assets/fontawesome/css/fontawesome-all.css" rel="stylesheet">
    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="container">
      <img src="../assets/ths.png" alt="">
      <h1>T.I.S.I.S</h1>
      <form action="login.php" method="post" autocomplete="off">
        <div id = "credentials">
          <div class="labels"><span><i class="fas fa-user"></i></span></div><input type="text" name="username" placeholder="Username"><br>
          <div class="labels"><span><i class="fas fa-unlock-alt"></i></span></div><input type="password" name="password" placeholder="Password">
        </div>
        <input type="submit" name="submit" value="Log In">
        <?php if(isset($msg) && isset($_POST['submit'])) {?>
        <div class="error"><?php echo $msg;?></div>
         <?php } ?>
      </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>
