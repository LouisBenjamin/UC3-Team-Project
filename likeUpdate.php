<?php

// Connection parameters
$dsn  = 'mysql:host=35.203.99.197;dbname=tato';
$user =	'test';
$pass =	'tatouc3';

try{
    // Connect to DB
    $pdo = new PDO($dsn, $user, $pass);
    // Get value sent by AJAX
    $tato_id = $_POST['val'];

    $pdo->beginTransaction();
    // Prepare update statement
    $query = 'UPDATE tatos 
                SET likes_count = 
                CASE WHEN likes_count IS NOT NULL 
                THEN likes_count + 1 
                ELSE 1 
                END 
                WHERE tato_id=? LIMIT 1';
    $stmt= $pdo->prepare($query);
    $stmt->execute(array($tato_id));
    $pdo->commit();
    $pdo=null;
    
}catch(PDOException $e){
    echo 'Connection error!' .$e-> getMessage();
}



?>