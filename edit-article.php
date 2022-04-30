<?php

    ini_set('display_errors', 1); 
    require 'includes/database-connection.php'; 
    require 'includes/article.php'; 
    
    $connection = getDB();
    if (isset($_GET['id'])) {
        $article = getArticleFromDB($connection, $_GET['id']);
        if ($article) {
            $title = $article['title'];
            $content = $article['content'];
            $published_at = $article['published_at'];
        } else {
            die('No Such Article Found!');
        }
    } else {
        die('Article ID is Not Supplied!');
    }

    var_dump($article);
    
?>

<?php require 'includes/header.php'; ?>

<h2>Edit article</h2>

<?php require 'includes/article-form.php'; ?>