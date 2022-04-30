<?php

ini_set('display_errors', 1); 
require 'includes/database-connection.php'; 
require 'includes/article.php'; 

$title = '';
$content = '';
$published_at = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);

    if (empty($errors)) {

        $connection = getDB();

        $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($connection, $sql);

        if ($stmt === false) {

            echo mysqli_error($connection);

        } else {

            if ($published_at == '') {
                $published_at = null;
            }

            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

            if (mysqli_stmt_execute($stmt)) {

                $id = mysqli_insert_id($connection);
                echo "Inserted record with ID: $id";

                header("Location: article.php?id=$id");
                exit;

            } else {

                echo mysqli_stmt_error($stmt);

            }
        }

    }
}

?>

<?php require 'includes/header.php'; ?>

<h2>New article</h2>

<?php require 'includes/article-form.php'; ?>