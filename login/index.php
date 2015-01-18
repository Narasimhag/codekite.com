<?php
include('login.php'); // Includes Login Script
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/paper.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>

	<div class = "row">
		<!--<div class = "container">
			<div class="jumbotron">
				
			</div>
		</div>-->
		<div class = "col-lg-6 col-lg-offset-3">
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			<div class = "well"> 
				<img src="kite-logo.png" class="img-responsive">
				<form class="form-horizontal" action="" method="post">
			  		<div class="form-group">
			    		<label for="emailid" class="col-sm-2 control-label col-sm-offset-2">User Name</label>
			    		<div class="col-sm-6">
			      			<input type="text" class="form-control" id="name" name="username" placeholder="username">
			    		</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="userpass" class="col-sm-2 control-label col-sm-offset-2">Password</label>
			    		<div class="col-sm-6">
			      			<input type="password" class="form-control" id="password" name="password" placeholder="**********">
			    		</div>
			  		</div>
			  		<div class="form-group">
			    		<div class="col-sm-offset-4 col-md-8 ">
			      			<input type="submit" value="Sign In" name="submit" class="btn btn-success">
			      			<a class="btn btn-info" href="../signup">Sign Up</a>
			    		</div>
                                                <span><?php echo $error; ?></span>
			  		</div>
				</form>
			</div>
		</div>
	</div>
		
</body>
</html>