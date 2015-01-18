<?php
if (isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $connection = mysql_connect("localhost", "codekite", "codekite");
    // To protect MySQL injection for Security purpose
    $username = stripslashes($username);
    $password = stripslashes($password);
    $email = stripslashes($email);
    $username = mysql_real_escape_string($username);
    $password = mysql_real_escape_string($password);
    $email = mysql_real_escape_string($email);
    // Selecting Database
    $db = mysql_select_db("codekite", $connection);
    // SQL query to fetch information of registerd users and finds user match.
    $query = mysql_query("INSERT INTO users (user_name, password, email)
    VALUES ('$username', '$password', '$email');", $connection);

    if($query){
      header("location: ../login/index.php");
    }
}
?>