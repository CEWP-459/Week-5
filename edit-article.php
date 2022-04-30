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

    var_dump($article);
    
?>

<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<?php require 'includes/article-form.php'; ?>