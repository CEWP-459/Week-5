<?php

function getDB() {
    
    $db_host = "localhost";
    $db_name = "blog";
    $db_username = "blog_www";
    $db_password = "LZR]PHvInWKW!]6*";
    
    $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    
    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }    

    return $connection;

}