<?php
require_once __DIR__.'./core/init.php';

?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>tato</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="assets/css/font-awesome.css"/>
		<link rel="stylesheet" href="assets/css/login.css"/>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/jquery.min.js" defer></script>
        <script src="assets/js/bootstrap.min.js" defer></script>
	</head>
	<!--Helvetica Neue-->
	
	<body>


    <div class="container-fluid">
		  <div class="row no-gutter">
		    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
		    <div class="col-md-8 col-lg-6">
		      <div class="login d-flex align-items-center py-5">
		        <div class="container">
		          <div class="row">
		            <div class="col-md-9 col-lg-8 mx-auto">
		              <h3 class="login-heading mb-4">Welcome to Tato</h3>
                        <?php require_once "includes/login.php"; ?>
                        <?php require_once "includes/signup.php"; ?>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>



</body>
</html>