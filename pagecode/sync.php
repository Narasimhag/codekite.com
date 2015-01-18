<?php 
	include('../session.php');
	$code_page_name=$_GET['code_page_name'];
	$code = $_GET['code'];
	echo $code;

    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysql_connect("localhost", "codekite", "codekite");
    // To protect MySQL injection for Security purpose
    // Selecting Database
    $db = mysql_select_db("codekite", $connection);
    // SQL query to fetch information of registerd users and finds user match.

   	$query = mysql_query("UPDATE codepages SET code = '$code' WHERE code_page_name = '$code_page_name'"
, $connection);
    if($query === FALSE) {
    	die(mysql_error());
    }
    echo "success";
?>