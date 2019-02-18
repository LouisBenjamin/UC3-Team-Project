<?php
    include 'database/connection.php';
    include  'classes/user.php';
    include  'classes/tato.php';

    global $pdo;
    session_start();
    $_SESSION["user"] = "NULL";
    $getUser=new User($pdo);
    $getTato=new Tato($pdo);
    define("Base_URL", "http://localhost/tato/");
?>