<?php

include  'core/init.php';
date_default_timezone_set("EST");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = $_SESSION['user_id'];

//$loggedInUser = "NULL";
if(isset($_SESSION['user_id'])) {
    $loggedInUser = $_SESSION['user_id'];
}

if(isset($_POST['tato'])) {
    $text = htmlspecialchars($_POST['tatoText']);

    if (strlen($text) > 140){
        $error = "Length exceeds 140 characters. ";
    }
    else{
        $getTato->postTato($user_id,$text);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Tato</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Tato</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active" id="post-new"><a href="index.php">Posts</a></li>
                        <li><a href="#" id="post-list">About</a></li>
                        <li><a href="admin" id="categories-editor">Admin</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-md-12">
	            <h4>Leave a Tato</h4>
                <form role="form" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="tatoText" rows="3" required></textarea>
                        <?php
                        if(isset($error)){
                            echo '<div class="span-fp-error">'.$error.'</div>';
                        } 
                        ?>
                    </div>
                    <button type="submit" name="tato" class="btn btn-success">Submit</button>
                </form>
                <?php $getTato->showTatoes(); ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
