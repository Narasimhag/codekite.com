<?php
    include('../session.php');
	$code=base64_encode($_POST['code']);
	echo 	($code);
	$code_page_name = $_POST['code_page_name'];
	$user_id = $_SESSION["user_id"];
	echo $user_id;
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysql_connect("localhost", "codekite", "codekite");
    // To protect MySQL injection for Security purpose
    // Selecting Database
    $db = mysql_select_db("codekite", $connection);
    // SQL query to fetch information of registerd users and finds user match.
    $query = mysql_query("INSERT INTO codepages (user_id,code_page_name,code) VALUES ('$user_id','$code_page_name','$code');", $connection);
    echo "string";
    if($query){
    	$post_to = "http://localhost/codekite.com/pagecode/index.php?page=".$code_page_name;
    	echo $post_to;
      header("location: $post_to");
    }
?>