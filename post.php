<?php
require 'header.php';

$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = ${id}";
$result = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "DELETE FROM posts WHERE id = ${id}";
    mysqli_query($conn, $query);
    header('Location: index.php');
}

?>

<div class="container">
    <div class="col-lg-8">

        <h1 class="mt-4"><?= $post['title'] ?></h1>

        <p class="lead"> by
            <span class="font-weight-bold">
                <?= $post['author'] ?>
            </span>
        </p>
        <hr>

        <p>Posted on <?= $post['created_at'] ?> </p>
        <hr>

        <p class="lead"><?= $post['body'] ?></p>
        <hr>

        <div class=" d-flex">
            <a href="editpost.php?id=<?= $post['id'] ?>" class="btn btn-info mr-2">Edit post</a>

            <form action="" method="POST">
                <button class="btn btn-danger">Delete post</button>
            </form>
        </div>
    </div>
</div>