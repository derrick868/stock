<?php include "includes/db.php";?>
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
      <div class="col-md-10" style="margin-left: 60px">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center;">
            <h3 class="panel-title">Registration</h3>
          </div>
          <div class="panel-body">

            <div class="messages">
            
            </div>


            
<?php


if(isset($_POST['reg'])){
	$firstname=$_POST['fname'];
	$lastname=$_POST['lname'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$date=date('y-m-d');


$password=password_hash($password, PASSWORD_BCRYPT,array('cost=>10') );
	$query="INSERT INTO users(firstname,lastname,username,password,email,phone,date,status) ";
	$query.="VALUES('{$firstname}','{$lastname}','{$username}','{$password}','{$email}','{$phone}',now(),'unapproved')";
	$select=mysqli_query($connection,$query);
	if($select){
		echo "<p class='alert alert-success' style='margin-top:30px'>Details Successfully Submitted...<p>".""."<a href='index.php'>Back to login</a>";
	}else{
		echo "<p class='alert alert-danger' style='margin-top:30px'>error while adding<p>";
	}
}



?>
<form class="form-horizontal " method="post"  enctype="multipart/form-data">
							
							
							<div class="row col-md-12" style="margin-bottom: 10px">	
									<div class="col-md-6">
										<label>Firstname</label>
										<input type="text" name="fname" value="" class="form-control" required>
									</div>

									<div class="col-md-6">
										<label>lastname</label>
										<input type="text" name="lname" value="" class="form-control" required>
									</div>
							</div>
							<div class="clearfix space20"></div>
							
							<div class="row col-md-12"  style="margin-bottom: 10px">	
									<div class="col-md-6">
										<label>Username</label>
										<input type="text" name="username" value="" class="form-control" required>
									</div>

									<div class="col-md-6">
										<label>Password</label>
										<input type="password" name="password" value="" class="form-control" required>
									</div>
							</div>

							<div class="clearfix space20"></div>
							<div class="row col-md-12"  style="margin-bottom: 10px">	
									<div class="col-md-6">
										<label>Email</label>
										<input type="email" name="email" value="" class="form-control" >
									</div>

									<div class="col-md-6">
										<label>Phone</label>
										<input type="text" name="phone" value="" class="form-control" required>
									</div>
							</div>
							<div class="clearfix space20"></div>
							
								<div class="col-md-6" style="padding: 10px">
									<button type="submit" class="button btn-primary pull-right" name="reg">Submit</button>
								</div>
							</div>
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
