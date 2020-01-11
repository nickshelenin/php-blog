<?php
require './config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>php blog</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Home</a>

            <div class="form-inline my-2 my-lg-0" action="createpost.php" method="post">
                <form action="createpost.php" class="mr-3">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="create-btn">Create post</button>
                </form>

                <a href="loginpage.php" class="btn btn-info mr-3 text-white" type="submit" name="create-btn">Log in</a>

                <a href="signuppage.php" class="btn btn-info mr-3 text-white" type="submit" name="create-btn">Sign up</a>

                <form action="">
                    <button class="btn btn-info my-2 my-sm-0" type="submit" name="create-btn">Log out</button>
                </form>
            </div>
        </div>
    </nav>