<?php
require './header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $title = $_POST['title'];
   $body = $_POST['body'];
   $author = $_POST['author'];

   if (!empty($title) && !empty($body) && !empty($author)) {
      $sql = "INSERT INTO posts(title,body,author) values(:title, :body, :author)";
      $stmt = $dbh->prepare($sql);
      $stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);
      header("Location: index.php");
   } else {
      echo "Error: fields cannot be empty";
   }
}
?>

<?php if (isset($_SESSION['userId'])) { ?>

   <form class="container mt-5" method="POST" action="">
      <h1 class="mb-5">Create post</h1>
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

<?php } else {
   header("Location: login.php");
} ?>

<?
require './footer.php';
?>