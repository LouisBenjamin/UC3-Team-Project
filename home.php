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


        <nav class="navbar navbar-inverse">

        <nav class="navbar navbar-default">

            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Tato</a>
                </div>


                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active" id="post-new"><a href="index.php">Home</a></li>

                        <!-- redirect to -->
                        <li><a href="#" id="post-list">About</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                       <li><a  href="admin" id="categories-editor"><span class="glyphicon glyphicon-user"></span> My Account</a></li>

                       <!-- redirect to -->
                       <li><a href="#">Logout</a></li>
                    </ul>
                </div>

            </div>
        </nav>

<div class="container text-center">    
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p><a href="#">My Profile</a></p>
        <img src="assets/images/profilepic.png" class="img-circle" height="65" width="65" alt="Avatar">
        <h5 style='text-align: left'><b> User Name: </b></h5>
        <h5 style='text-align: left'><b> User ID: </b></h5>
        <h5 style='text-align: left'><b> Followers: </b></h5>
      </div>

      <div class="well">
        <p><a href="#">Interests</a></p>
        <p>
          <span class="label label-default">Category</span>
          <span class="label label-primary">Category</span>
          <span class="label label-success">Category</span>
          <span class="label label-info">Category</span>
          <span class="label label-warning">Category</span>
          <span class="label label-danger">Category</span>
        </p>
      </div>
    </div>
    <div class="col-sm-7">
    
        <div class="row">

            <div class="col-md-12">
	            <h4 style='text-align: left'>Leave a Tato</h4>

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

                   <div style='text-align: left'> <button type="submit" name="tato" class="btn btn-success">Submit</button> </div>
                </form>
                   <div style='text-align: left'> <?php $getTato->showTatoes(); ?> </div>
            </div>
        </div >
    </div>

  </div>
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
