<?php
require 'header.php';

$query = 'SELECT * FROM posts ORDER BY created_at DESC';
$result = mysqli_query($conn, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);
?>

<div class="container">
    <div class="col-md-8">
        <h1 class="my-4">PHP Blog
        </h1>

        <?php foreach ($posts as $post) : ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title"><?= $post['title'] ?></h2>
                    <p class="card-text"><?= $post['body'] ?></p>
                    <a class="btn btn-info" href="post.php?id=<?= $post['id'] ?>">Read more &rarr;</a>
                </div>

                <div class="card-footer text-muted">
                    Posted on <?= $post['created_at'] ?> by
                    <?= $post['author'] ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php
require 'footer.php';
