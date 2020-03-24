<?php
require './header.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM posts WHERE id = :id';
$stmt = $dbh->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $sql = 'DELETE FROM posts WHERE id = :id';
   $stmt = $dbh->prepare($sql);
   $stmt->execute(['id' => $id]);
   header('Location: index.php');
}
?>

<?php if (isset($_SESSION['userId'])) { ?>

   <div class="container">
      <div class="col-lg-8">
         <h1 class="mt-4 mb-4"><?= $post['title'] ?></h1>

         <div class="lead">
            <span>by</span>
            <span class="font-weight-bold">
               <?= $post['author'] ?>
            </span>
         </div>
         <hr>

         <div class="lead">
            <p><?= $post['body'] ?></p>
         </div>
         <hr>

         <div>
            <span>Posted on</span>
            <span><?= $post['created_at'] ?></span>
         </div>
         <hr>

         <div class="d-flex">
            <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-info mr-2">Edit post</a>
            <form action="" method="POST">
               <button class="btn btn-danger">Delete post</button>
            </form>
         </div>
      </div>
   </div>


<?php } else {
   header("Location: login.php");
} ?>

<?php
require './footer.php';
?>