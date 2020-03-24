<?php
require './header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // validate inputs
   function validateInput($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }

   $email = validateInput($_POST['email']);
   $pass = validateInput($_POST['pass']);

   if (empty($email) || empty($pass)) {
      header("Location: login.php?error=emptyfileds");
      exit();
   } else {
      $sql = "SELECT id, email, password FROM users WHERE email=:email";
      $stmt = $dbh->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      // if returns 1, email already exists thus throwing error
      if ($stmt->rowCount() == 1) {
         if ($row = $stmt->fetch()) {
            $passCheck = password_verify($pass, $row['password']);

            if (!$passCheck) {
               header("Location: login.php?error=wrongpassword");
               exit();
            } else {
               session_start();
               $_SESSION['userId'] = $row['id'];

               header("Location: index.php?login=success");
               exit();
            }
         }
      } else {
         header("Location: login.php?error=emailnotexists");
         exit();
      }
   }
}
?>

<div class="container">
   <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
         <div class="card card-signin my-5">
            <div class="card-body">
               <h5 class="card-title text-center mb-4">Log In</h5>
               <form class="form-signin" method="POST" action="">
                  <div class="form-label-group mb-4">
                     <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                  </div>

                  <div class="form-label-group mb-4">
                     <input type="password" class="form-control" name="pass" placeholder="Password" required>
                  </div>
                  <button class="btn btn-lg btn-info btn-block text-uppercase" type="submit">Log in</button>
                  <hr class="my-4">
               </form>
               <div class="text-center">
                  <p>Don't have an account yet? </p>
                  <a href="signup.php">Sign up</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
require './footer.php';
?>