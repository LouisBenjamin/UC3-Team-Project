<?php

session_start();
include 'database/connection.php';
include 'classes/UserManager.php';
include 'classes/tato.php';

$pdo = Dbh::getInstance()->dbh;
$getUserManager = new UserManager($pdo);
$getTato = new Tato($pdo);
