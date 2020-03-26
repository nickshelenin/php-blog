<?php
require './header.php';

$err = "";
$nameErr = "";
$emailErr = "";
$passErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // validate inputs
   function validateInput($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }

   $name = validateInput($_POST['name']);
   $email = validateInput($_POST['email']);
   $pass = validateInput($_POST['pass']);
   $passRepeat = validateInput($_POST['pass-repeat']);

   // checking if any of inputs are empty
   if (empty($name) || empty($email) || empty($pass) || empty($passRepeat)) {
      $err = "Fields cannot be empty";
      header("Location: signup.php?error=emptyfileds&name=${name}&email=${email}");
      exit();
   // checking if name and email are invalid
   } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $name) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err = "Invalid name and email";
      header("Location: signup.php?error=invalidname&email");
      exit();
   // checking if name input is invalid
   } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
      $nameErr = "Invalid name";
      header("Location: signup.php?error=invalidname");
      exit();
   // checking if email input is invalid 
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email";
      header("Location: signup.php?error=invalidemail");
      exit();
   // checking if password is less than 4 characters
   } elseif (strlen($pass) < 4) {
      $passErr = "Short password";
      header("Location: signup.php?error=shortpassword&name=${name}&email=${email}");
      exit();
   // checking if password and password repeat inputs do not match
   } elseif ($pass !== $passRepeat) {
      $passErr = "Passwords do not match";
      header("Location: signup.php?error=passwordmatch&name=${name}&email=${email}");
      exit();
   } else {
      // check if email already exists
      $sql = 'SELECT email FROM users WHERE email=:email';
      $stmt = $dbh->prepare($sql);
      $stmt->bindParam(':email', $email);

      $stmt->execute();
      // if returns 1, email already exists thus throwing error
      if ($stmt->rowCount() == 1) {
         header("Location: signup.php?error=emailexists");
         exit();
      } else {
         $passHash = password_hash($pass, PASSWORD_DEFAULT);
         $sql = 'INSERT INTO users(name,email,password) values(:name,:email,:password)';
         $stmt = $dbh->prepare($sql);
         $stmt->execute(['name' => $name, 'email' => $email, 'password' => $passHash]);
         header("Location: login.php?signup=success");
         exit();
      }
   }
   $dbh = null;
}

?>

<div class="container">
   <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
         <div class="card card-signin my-5">
            <div class="card-body">
               <h5 class="card-title text-center mb-4">Sign up</h5>
               <form class="form-signin" method="POST" action="">
                  <div>
                     <span><?= $err ?></span>
                  </div>

                  <div class="form-label-group mb-4">
                     <input type="text" class="form-control" placeholder="Name" name="name" required autofocus>
                     <span><?= $nameErr ?></span>
                  </div>

                  <div class="form-label-group mb-4">
                     <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus>
                     <span><?= $emailErr ?></span>
                  </div>

                  <div class="form-label-group mb-4">
                     <input type="password" class="form-control" placeholder="Password" name="pass" required>
                     <span><?= $passErr ?></span>
                  </div>

                  <div class="form-label-group mb-4">
                     <input type="password" class="form-control" placeholder="Repeat password" name="pass-repeat" required>
                  </div>

                  <button class="btn btn-lg btn-info btn-block text-uppercase" type="submit">Sign up</button>
                  <hr class="my-4">
               </form>

               <div class="text-center">
                  <p>Already have an account? </p>
                  <a href="login.php">Log in</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
require './footer.php';
?>