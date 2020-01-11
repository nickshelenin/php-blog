<?php
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = 'INSERT INTO posts (title, body, author) values (?, ?, ?)';
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo 'SQL stmt failed';
    } else {
        if (isset($_POST['title'])) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $body = mysqli_real_escape_string($conn, $_POST['body']);
            $author = mysqli_real_escape_string($conn, $_POST['author']);

            if (!empty($title) && !empty($body) && !empty($author)) {
                mysqli_stmt_bind_param($stmt, "sss", $title, $body, $author);
                mysqli_stmt_execute($stmt);
                header('Location: index.php');
            } else {
                echo 'Fields can\'t be empty';  
            }
        }
    }
}
?>

<form class="container mt-5" method="post" action="">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="title" name="title">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="name" name="author">
    </div>

    <div class="form-group">
        <textarea class="form-control" name="body" placeholder="body"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>