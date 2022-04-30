<?php

    ini_set('display_errors', 1); 
    require 'includes/database-connection.php'; 
    require 'includes/article.php'; 
    
    $connection = getDB();
    $article = getArticleFromDB($connection, $_GET['id']);
    
?>

<?php require 'includes/header.php'; ?>
<body>
    <h1>Blog</h1>
    <?php if ($article === null) : ?>
        <h2> No articles found! </h2>
    <?php else: ?>    
        <ol>
            <li>
                <h3>Title:</h3>
                <?= htmlspecialchars($article['title']); ?>
                <h3>Content:</h3>
                <?= htmlspecialchars($article['content']); ?>
            </li>
        </ol>
    <?php endif; ?>    
</body>

</html>