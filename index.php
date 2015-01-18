<?php
include('session.php');

///-----------------------


    $connection = mysql_connect("localhost", "codekite", "codekite");
    $db = mysql_select_db("codekite", $connection);
 
    $user_name = $_SESSION['user_name'];
    $sqlCommand2 = "SELECT user_id FROM users WHERE user_name = '$user_name' LIMIT 1";
    $query = mysql_query($sqlCommand2);
    if($query === FALSE) {
       die(mysql_error());
    }

    $row = mysql_fetch_assoc($query);

    $user_id = $row['user_id'];




///-----------------------


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DashBoard</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script	src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/paper.css">
</head>
<body>
	<!--Nav Bar code-->
	<nav class="navbar navbar-inverse" role="navigation">
  		<div class="container-fluid">
  			<div class="navbar-header">
  				<a class="navbar-brand" href="index.php">CodeKite</a>
  			</div>
        <a href="./pagecode" class="btn btn-warning navbar-btn" data-toggle="tooltip" data-placement="bottom" title="Create new Code Page" style="margin-left:42em;"><span class="glyphicon glyphicon-plus"></span></em></a>

  			<ul class="nav navbar-nav navbar-right">
	  			<li class="dropdown">
			         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['user_name']."&nbsp;&nbsp;&nbsp;"; ?><span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="#">Report Bugs!</a></li>
			            <li class="divider"></li>
			            <li><a href="logout.php">Logout</a></li>
			          </ul>
	        	</li>
  			</ul>
  		</div>
  	</nav>
	
	<!--Create new Code button-->
	<!--<p class="col-md-2 col-md-offset-5">
	<a href="./pagecode" class="btn btn-info btn-lg" style="margin-left:25px;">Create new <em>code page</em></a>-->
	<br><br>
	
		        <h4 style="margin-left:10px;">Own Pages</h4>
			<table class="table table-striped table-bordered">
				<thead>
			  		<tr>
			  			<th>CodePage Name</th>
			  			<th>Created</th>
			  			<th>Shared with</th>
			  			
			  		</tr>
			  	</thead>
			  	<tbody>

			  			<?php
                                                  
                                                        $sqlCommand2 = "SELECT * FROM codepages WHERE user_id = '$user_id'";
                                                        $query = mysql_query($sqlCommand2);
                                                        if($query === FALSE) {
                                                           die(mysql_error());
                                                        }
                                                        while($row = mysql_fetch_assoc($query)){
                                                            echo "<tr><td><a href='http://localhost/codekite.com/pagecode/index.php?page=".$row['code_page_name']."'>".$row['code_page_name']."</a></td>";
                                                            echo "<td>".$row['created']."</td>";
                                                            echo "<td>Praveen</td></tr>";
                                                        }

                                                  ?>

	  			</tbody>
			</table>
		
	                               <h4 style="margin-left:10px;">Invited Pages</h4>
	<table class="table table-striped table-bordered">
	

				<thead>
			  		<tr>
			  			<th>Page Name</th>
			  			<th>Created</th>
			  			<th>Invited by</th>

			  		</tr>
			  	</thead>

			  	<tbody>
                                             <?php
                                                        $sqlCommand2 = "SELECT access_id FROM access WHERE user_id = '$user_id'";
                                                        $query = mysql_query($sqlCommand2);
                                                        if($query === FALSE) {
                                                           die(mysql_error());
                                                        }
                                                        while($row = mysql_fetch_assoc($query)){
                                                            $access_id =  $row['access_id'];

                                                            $sqlCommand3 = "SELECT * FROM codepages WHERE access_id = '$access_id'";
                                                            $query1 = mysql_query($sqlCommand3);
                                                            if($query1 === FALSE) {
                                                               die(mysql_error());
                                                            }

                                                            $row2 = mysql_fetch_assoc($query1);

                                                            $user_id = $row2['user_id'];

                                                              echo "<tr><td><a href='http://localhost/codekite.com/pagecode/index.php?page=".$row2['code_page_name']."&mode=readonly'>".$row2['code_page_name']."</a></td>";
                                                              echo "<td>".$row2['created']."</td>";
                                                              
                                                                  $sqlCommand3 = "SELECT * FROM users WHERE user_id = '$user_id'";
                                                                  $query2 = mysql_query($sqlCommand3);
                                                                  if($query2 === FALSE) {
                                                                     die(mysql_error());
                                                                  }
                                                              
                                                                  $row3 = mysql_fetch_assoc($query2);
      
                                                                  echo "<td>".$row3['user_name']."</td></tr>";
                                                              


                                                        }



                                           ?>
	  			</tbody>
			</table>

		
            

</body>
</html>