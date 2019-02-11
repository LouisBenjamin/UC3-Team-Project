<?php

 	//$dsn   = 'mysql:dbname=tato;unix_socket=/cloudsql/tato-231220:northamerica-northeast1:bestteam2019';
  	$dsn  = "mysql:host=35.203.99.197;dbname=tato";
    $user =	"test";
    $pass =	"tatouc3";

    try{
    	$pdo = new PDO($dsn, $user, $pass);
    	echo "Connected successfully"; 
    }catch(PDOException $e){
    	echo 'Connection error!' .$e-> getMessage();
    }

  ?>  

  