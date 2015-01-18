<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "codekite", "codekite");
// Selecting Database
$db = mysql_select_db("codekite", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['user_name'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select user_name from users where user_name='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['user_name'];
if(!isset($_SESSION['user_name'])){
mysql_close($connection); // Closing Connection
//echo $login_session;
header('Location: http://localhost/codekite.com/login/'); // Redirecting To Home Page
}
?>