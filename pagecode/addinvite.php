<?php
    include('../session.php');
    $code_page_name = $_GET['code_page_name'];
    $user_name = $_GET['user_name'];

    $connection = mysql_connect("localhost", "codekite", "codekite");
    
    $db = mysql_select_db("codekite", $connection);
    //for access_id
    $ses_sql=mysql_query("select access_id from codepages where code_page_name='$code_page_name'", $connection);
    $row = mysql_fetch_assoc($ses_sql);
    $access_id =$row['access_id'];
    //for user_id
    $ses_sql=mysql_query("select user_id from users where user_name='$user_name'", $connection);
    $row = mysql_fetch_assoc($ses_sql);
    $user_id =$row['user_id'];

    $query = mysql_query("INSERT INTO access (access_id,user_id) VALUES ('$access_id','$user_id');", $connection);
    if($query === FALSE) {
        die(mysql_error());
    }
    echo "success";
?>