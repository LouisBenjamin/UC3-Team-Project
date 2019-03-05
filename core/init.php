<?php


session_start();
include 'database/connection.php';
include 'classes/user.php';
include 'classes/tato.php';

$pdo = Dbh::getInstance()->dbh;
$getUser = new User($pdo);
$getTato = new Tato($pdo);
define("Base_URL", "http://localhost/tato/");
