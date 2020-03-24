<?php
require './header.php';

$sql = 'SELECT * FROM posts ORDER BY created_at DESC';
$stmt = $dbh->query($sql);
$posts = $stmt->fetchAll();

function sliceString($string)
{
   if (strlen($string) <= 550) {
      return substr($string, 0, 550);
   } else {
      return substr($string, 0, 550) . '...';
   }
}
?>

<?php if (isset($_SESSION['userId'])) { ?>

   <div class="container">
      <div class="col-md-8">
         <h1 class="my-4">PHP Blog</h1>

         <?php foreach ($posts as $post) : ?>
            <div class="card mb-4">
               <div class="card-body">
                  <h2 class="card-title"><?= $post['title']; ?></h2>
                  <p class="card-text"><?= sliceString($post['body']) ?></p>
                  <a class="btn btn-info" href="post.php?id=<?= $post['id']; ?>">Read more &rarr;</a>
               </div>

               <div class="card-footer text-muted">
                  Posted on <?= $post['created_at']; ?> by
                  <?= $post['author']; ?>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>

<?php } else {
   header("Location: login.php");
} ?>


<?php require './footer.php'; ?>