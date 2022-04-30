<?php

ini_set('display_errors', 1); 
require 'includes/database-connection.php'; 
require 'includes/article.php'; 

$connection = getDB();
if (isset($_GET['id'])) {
    $article = getArticleFromDB($connection, $_GET['id']);
    if ($article) {
        $id = $article['id'];
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {
        die('No Such Article Found!');
    }
} else {
    die('Article ID is Not Supplied!');
}

$sql = "DELETE FROM article 
        WHERE  id = ?";
$stmt = mysqli_prepare($connection, $sql);
if ($stmt === false) {
    echo mysqli_error($connection);
} else {
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
    } else {
        echo mysqli_stmt_error($stmt);
    }
}

?>