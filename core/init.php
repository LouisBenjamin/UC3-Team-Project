<?php

session_start();
include 'database/connection.php';
include 'classes/UserManager.php';
include 'classes/TatoManager.php';

$pdo = Dbh::getInstance()->dbh;
$getUserManager = new UserManager($pdo);
$getTatoManager = new TatoManager($pdo);
