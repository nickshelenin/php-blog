<?php

$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'posts_db';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = mysqli_connect($server, $user, $pwd, $db);
