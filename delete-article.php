<?php

ini_set('display_errors', 1); 
require 'includes/database-connection.php'; 
require 'includes/article.php'; 

$connection = getDB();
if (isset($_GET['id'])) {
    $article = getArticleFromDB($connection, $_GET['id'], 'id');
    if ($article) {
        $id = $article['id'];
    } else {
        die('No Such Article Found!');
    }
} else {
    die('Article ID is Not Supplied!');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
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
}

?>


<?php require 'includes/header.php'; ?>

<h2> Delete article </h2>
<h3> Are you sure? </h3>
<form method="post">
    <button>Delete Article</button>
</form> 
<a href="./single-article.php?id=<?= $article['id'] ?>">Cancel</a>  