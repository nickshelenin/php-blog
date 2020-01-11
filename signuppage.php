<?php
require 'header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Sign up</h5>
                    <form class="form-signin" method="post" action="signup.php">
                        <div class="form-label-group mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name" required autofocus>
                        </div>

                        <div class="form-label-group mb-4">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
                        </div>

                        <div class="form-label-group mb-4">
                            <input type="password" class="form-control" placeholder="Password" name="pwd" required>
                        </div>

                        <div class="form-label-group mb-4">
                            <input type="password" class="form-control" placeholder="Repeat password" name="pwd-repeat" required>
                        </div>

                        <button class="btn btn-lg btn-info btn-block text-uppercase" type="submit">Sign up</button>
                        <hr class="my-4">
                    </form>
                    <div class="text-center">
                        <p>Already have account? </p>
                        <a href="loginpage.php">Log in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>