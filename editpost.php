<?php
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $body = $_POST['body'];
    $query = "UPDATE posts SET title='${title}', author='${author}', body='${body}' WHERE id = ${id}";
    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    }
}

$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = ${id}";
$result  = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($result);

?>

<div class="container mt-5">
    <h1>Edit post</h1>

    <form method="post" action="">
        <div class="form-group">
            <input type="text" class="form-control" name="title" value="<?= $post['title'] ?>">
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="author" value="<?= $post['author'] ?>">
        </div>

        <div class="form-group">
            <textarea class="form-control" name="body"><?= $post['body'] ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>