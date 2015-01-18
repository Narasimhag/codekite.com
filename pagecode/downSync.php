<?php 
	include('../session.php');
	$code_page_name=$_GET['code_page_name'];

    
    $connection = mysql_connect("localhost", "codekite", "codekite");
    $db = mysql_select_db("codekite", $connection);

    $sqlCommand2 = "SELECT code FROM codepages WHERE code_page_name = '$code_page_name' ";
    $query = mysql_query($sqlCommand2);
    if($query === FALSE) {
       die(mysql_error());
    }

    $row = mysql_fetch_assoc($query);

    echo $row['code'];

    if($query === FALSE) {
    	die(mysql_error());
    }
?>