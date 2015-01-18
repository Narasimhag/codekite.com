<?php 
	include('../session.php');
	$access_id=$_GET['access_id'];
	$user_id = $_GET['user_id'];
	$update_string = $_GET['update_string'];
	$first_position = $_GET['first_position'];
	$type = $_GET['type'];

    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysql_connect("localhost", "codekite", "codekite");
    // To protect MySQL injection for Security purpose
    // Selecting Database
    $db = mysql_select_db("codekite", $connection);
    // SQL query to fetch information of registerd users and finds user match.

    													$sqlCommand = "SELECT * FROM access WHERE access_id = '$access_id'";
                                                        $query = mysql_query($sqlCommand);
                                                        if($query === FALSE) {
                                                           die(mysql_error());
                                                           echo "error in query exe";
                                                        }
                                                        while($row = mysql_fetch_assoc($query)){
                                                            $user_id2 = $row['user_id'];
                                                            $query2 = mysql_query("INSERT INTO `update`(`user_id`,`update_string`,`first_position`,`access_id`,`type`) VALUES('$user_id2','$update_string','$first_position','$access_id','$type');", $connection);
                                                            if($query2 === FALSE) {
	                                                           die(mysql_error());
	                                                           echo "error in query exe";
	                                                        	}

                                                        }

    
    echo "success";
?>