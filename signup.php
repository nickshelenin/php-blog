<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require './config/db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwd-repeat'];

    if (empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
        header("Location: signuppage.php?error=emptyfileds&name=${name}&email=${email}");
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $name) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signuppage.php?error=invalidname&email");
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        header('Location: signuppage.php?error=invalidname');
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signuppage.php?error=invalidemail");
        exit();
    } elseif (!strlen($pwd) >= 6) {
        header("Location: signuppage.php?error=shortpwd&name=${name}&email=${email}");
        exit();
    } elseif ($pwd !== $pwdRepeat) {
        header("Location: signuppage.php?error=pwdcheck&name=${name}&email=${email}");
        exit();
    } else {
        $query = "SELECT userName from users WHERE userName = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            header('Location: signuppage.php?error=sqlerror');
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);

            if ($result > 0) {
                header("Location: signuppage.php?error=nametaken&email=${email}");
                exit();
            } else {
                $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

                $query = 'INSERT INTO users (userName, userEmail, userPwd) VALUES (?,?,?)';
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header('Location: signuppage.php?error=sqlerror');
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $pwdHash);
                    mysqli_stmt_execute($stmt);
                    header('Location: index.php?login=success');
                }
            }
        }
    }
} else {
    header('Location: signuppage.php');
}
