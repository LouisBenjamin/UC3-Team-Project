 <?php
    include 'database/connection.php';
    include  'classes/user.php';

    global $pdo;
    session_start();
    $getUser=new User($pdo);

    define("Base_URL", "http://localhost/tato/"); 
 ?>