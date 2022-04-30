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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $published_at = $_POST['published_at'];
        $errors = validateArticle($title, $content, $published_at);
        if (empty($errors)) {
            $sql = "UPDATE article 
                    SET    title = ?, 
                           content = ?, 
                           published_at = ? 
                    WHERE  id = ?";
            $stmt = mysqli_prepare($connection, $sql);
            if ($stmt === false) {
                echo mysqli_error($connection);
            } else {
                if ($published_at == '') {
                    $published_at = null;
                }
                mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: single-article.php?id=$id");
                    exit;
                } else {
                    echo mysqli_stmt_error($stmt);
                }
            }
        }
    }
    
?>

<?php require 'includes/header.php'; ?>

<h2>Edit article</h2>

<?php require 'includes/article-form.php'; ?>