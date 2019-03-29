<?php

session_start();
include 'database/connection.php';
include 'classes/UserManager.php';
include 'classes/TatoManager.php';
date_default_timezone_set('America/Toronto');
$pdo = Dbh::getInstance()->dbh;
$getUserManager = new UserManager($pdo);
$getTatoManager = new TatoManager($pdo);
