<?php

    ini_set('display_errors', 1); 
    require 'includes/database-connection.php'; 
    require 'includes/article.php'; 
    
    $connection = getDB();
    if (isset($_GET['id'])) {
        $article = getArticleFromDB($connection, $_GET['id']);
    } else {
        $article = null;
    }
    
?>