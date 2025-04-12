<?php include "includes/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product expiry management system</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/global.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">
	<script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  
<body>




<section id="course_home">
<div class="container">
    <div class="row vertical">
      <div class="col-md-5 col-md-offset-4">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Please Sign in</h3>
          </div>
          <div class="panel-body">

            <div class="messages">
            
            </div>


            <?php session_start(); ?>
<?php

if(isset($_POST['login'])){
  $username= $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_escape_string($connection,$username);
  $password = mysqli_escape_string($connection,$password);

  $query = "SELECT * FROM users WHERE username ='{$username}'";
  $login_query = mysqli_query($connection,$query);
  if(!$login_query){
    die("QUERY FAILED". mysqli_error($connection));
  }

  while($row = mysqli_fetch_array($login_query)){
    $db_user_id = $row['id'];
    $db_username = $row['username'];
    $db_user_password = $row['password'];
    $status=$row['status'];
  }
  

if($status=='approved'){
if(password_verify($password,$db_user_password)) {

$_SESSION['username'] = $db_username;
$_SESSION['id'] = $db_user_id;

header("Location:dashboard.php");
} else{
  echo "<p class='alert alert-danger' style='margin-top:30px'>Please enter the right credentials<p>";
}

}else{
    echo "<p class='alert alert-danger' style='margin-top:30px'>You have not been approved yet!!!<p>";
}




  

}
?>


            <form class="form-horizontal" action="" method="post" id="loginForm">
              <fieldset>
                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
                  </div>
                </div>                
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="login" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
                    Don't have an account?  <a href="reg.php">Create one </a>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
          <!-- panel-body -->
        </div>
        <!-- /panel -->
      </div>
      <!-- /col-md-4 -->
    </div>
    <!-- /row -->
  </div>
</section>
















</body>
 
</html>
