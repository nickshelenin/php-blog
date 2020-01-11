<?php
require 'header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Log In</h5>
                    <form class="form-signin" method="post" action="loginpage.php">
                        <div class="form-label-group mb-4">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                        </div>

                        <div class="form-label-group mb-4">
                            <input type="password" class="form-control" placeholder="Password" required>
                        </div>

                        <button class="btn btn-lg btn-info btn-block text-uppercase" type="submit">Log in</button>
                        <hr class="my-4">
                    </form>
                    <div class="text-center">
                        <p>Don't have an account yet? </p>
                        <a href="signuppage.php">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>