<?php

ini_set('display_errors', 1); 

function getArticleFromDB ($connection, $id) {
    $sql = "SELECT * FROM article WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_assoc($result);
        } else {
            echo mysqli_stmt_error($stmt);
        }
    }
}

?>