<?php
session_start();
$host = 'localhost';
$db = 'posts_db';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";
try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $dbh;
} catch (PDOException $e) {
    print $e->getMessage();
    die();
}
