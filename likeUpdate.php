<?php

// Connection parameters
$dsn  = "mysql:host=35.203.99.197;dbname=tato";
$user =	"test";
$pass =	"tatouc3";

try{
    // Connect to DB
    $pdo = new PDO($dsn, $user, $pass);
    // Get value sent by AJAX
    $tato_id = $_POST["val"];
    $data = [
        'tato_id' => $tato_id,
    ];
    
    $pdo->beginTransaction();
    
    // PRepare update statement
    $query = "UPDATE tatos SET likes_count = likes_count + 1 where tato_id=:tato_id";
    $stmt= $pdo->prepare($query);
    $stmt->execute($data);
    $pdo->commit();
    $pdo=null;
    
}catch(PDOException $e){
    echo 'Connection error!' .$e-> getMessage();
}



?>