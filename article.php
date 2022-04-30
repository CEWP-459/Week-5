<?php

    ini_set('display_errors', 1); 
    require 'includes/database-connection.php'; 
    
    $connection = getDB();
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $sql = "SELECT * FROM article WHERE id = {$_GET['id']}";
        // var_dump($sql);
        try {
            $result = mysqli_query($connection, $sql);
            if ($result) {
                $article = mysqli_fetch_array($result, MYSQLI_ASSOC);
            } else {
                echo "DB did not return a value: " . mysqli_error($connection);
            }
        } catch (Exception $e) {
            echo "ERROR: " . $e;
        }
    } else {
        $article = null;
    }
    
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