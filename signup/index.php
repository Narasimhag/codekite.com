<?php
include('signup.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../css/paper.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	
</head>
<body>
	<div class = "row">
		<!--<div class = "container">
			<div class="jumbotron">
				
			</div>
		</div>-->
		<br><br>
		<br><br>
		<br><br>
		<div class = "col-md-6 col-md-offset-3">


			<div class = "well"> 
				<h1 class="text-primary col-sm-offset-5" style="font-weight:bold;">Sign Up</h1>
				<br>
				<form class="form-horizontal" role="form" action="" method="post">
			  		<div class="form-group">
			    		<label for="username" class="col-sm-2 control-label col-sm-offset-2">Name</label>
			    		<div class="col-sm-6">
			      			<input type="text" class="form-control" id="username" name="username" placeholder="Enter your name">
			    		</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="emailid" class="col-sm-2 control-label col-sm-offset-2">Email</label>
			    		<div class="col-sm-6">
			      			<input type="text" class="form-control" id="emailid" name="email" placeholder="Email">
			    		</div>
			  		</div>

			  		<div class="form-group">
			    		<label for="userpass" class="col-sm-2 control-label col-sm-offset-2">Password</label>
			    		<div class="col-sm-6">
			      			<input type="password" class="form-control" id="userpass" name="password" placeholder="Password">
			    		</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="confirmpass" class="col-sm-3 control-label col-sm-offset-1">Confirm Password</label>
			    		<div class="col-sm-6">
			      			<input type="password" class="form-control" id="confirmpass" placeholder="Re-enter Password">
			    		</div>
			  		</div>
			  		<div class="form-group">
			    		<div class="col-sm-offset-4 col-md-8 ">
			      			<input type="submit" class="btn btn-success" value="Register" name="submit">
			    		</div>
			  		</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>