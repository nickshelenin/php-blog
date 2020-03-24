<?php
require './header.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM posts WHERE id = :id';
$stmt = $dbh->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $title = $_POST['title'];
   $body = $_POST['body'];
   $author = $_POST['author'];

   if (!empty($title) && !empty($body) && !empty($author)) {
      $sql = 'UPDATE posts SET title=:title, body=:body, author=:author WHERE id=:id';
      $stmt = $dbh->prepare($sql);
      $stmt->execute(['title' => $title, 'body' => $body, 'author' => $author, 'id' => $id]);
      header("Location: post.php?id=$id");
   } else {
      echo "Error: fields cannot be empty";
   }
}

?>

<?php if (isset($_SESSION['userId'])) { ?>

   <div class="container mt-5">
      <h1>Edit post</h1>

      <form method="POST" action="">
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

<?php } else {
   header("Location: login.php");
} ?>

<?php
require './footer.php';
?>