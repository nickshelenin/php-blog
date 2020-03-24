<?php
require './config/dbh.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <title>php blog</title>
</head>

<body>
   <header>
      <nav class="navbar navbar-dark bg-dark">
         <div class="container">
            <a class="navbar-brand" href="index.php">Home</a>
            <div class="form-inline my-2 my-lg-0" action="createpost.php" method="post">

               <?php if (isset($_SESSION['userId'])) { ?>
                  <form action="create_post.php" class="mr-3" method="POST">
                     <button class="btn btn-info my-2 my-sm-0" type="submit" name="create-btn">Create post</button>
                  </form>
                  <form action="logout.php" method="POST">
                     <button class="btn btn-danger my-2 my-sm-0" type="submit" name="create-btn">Log out</button>
                  </form>
               <?php } else { ?>
                  <a href="login.php" class="btn btn-success mr-3 text-white" type="submit" name="create-btn">Log in</a>
                  <a href="signup.php" class="btn btn-success mr-3 text-white" type="submit" name="create-btn">Sign up</a>
               <?php } ?>

            </div>
         </div>
      </nav>
   </header>