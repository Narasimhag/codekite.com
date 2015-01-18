<?php
    $connection = mysql_connect("localhost", "codekite", "codekite");
    $db = mysql_select_db("codekite", $connection);
 
    $user_name = $_SESSION['user_name'];
    echo $user_name;
    $sqlCommand2 = "SELECT user_id FROM users WHERE user_name = '$user_name' LIMIT 1";
    $query = mysql_query($sqlCommand2);
    if($query === FALSE) {
       die(mysql_error());
    }

    $row = mysql_fetch_assoc($query);

    $user_id = $row['user_id'];

    $sqlCommand2 = "SELECT code_page_name FROM codepages WHERE user_id = '$user_id'";
    $query = mysql_query($sqlCommand2);
    if($query === FALSE) {
       die(mysql_error());
    }
    while($row = mysql_fetch_assoc($query)){
        array_push($pages, $row['code_page_name']);
    }
?>