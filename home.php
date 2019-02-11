<?php
//phpinfo();

#include "includes/dbconfig.php";
#include "includes/db.php";
include  'core/init.php';

$dsn  = "mysql:host=35.203.99.197;dbname=tato";
    $user = "test";
    $pass = "tatouc3";
$conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tatos ORDER BY created DESC");
    $stmt->execute();
$result = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);

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
      <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3" required></textarea>
  
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
	
	
	
	
	

        <?php
        echo $result;
       while ($row = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {

            echo '<h1>' . $row['0'] . '</h1><p>' . $row['1'] . '</p><div><span class="badge">' . $row['2']. '</span>
           <div class="pull-right">
                <span class="label label-default">category</span>
                <span class="label label-primary">category</span>
                <span class="label label-success">category</span>
                <span class="label label-info">category</span>
                <span class="label label-warning">category</span>
                <span class="label label-danger">category</span>
            </div>
        </div>
        <hr>';
       }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
