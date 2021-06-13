<?php
    $host = 'herokuapp.com';
    $username = 'root';
    $password = '';
    $db = 'comicusers';
    
    $connection = mysqli_connect($host, $username, $password, $db);
    
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "";
    }
?>