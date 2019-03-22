<?php
require_once __DIR__.'./core/init.php';

if (isset($_POST['email']) && isset($_POST['pwd'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $login_error = "Invalid format";
    } else {
        if ($getUserManager->login($_POST['email'], $_POST['pwd']) === false) {
            $login_error = "The email or password is incorrect";
        } else {
            // Per http://php.net/manual/en/function.header.php
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $home_url = 'home.php';
            header("Location: http://$host$uri/$home_url");
            exit;
        }
    }
}
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
		              <form method="post">
		                <div class="form-label-group">
                            <?php
                            if (isset($_POST['email'])) {
                                //echo '<input type="text" name="email" value="' . htmlspecialchars($_POST['email']) . '" />';
                                echo '<input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" 
                                value="' . htmlspecialchars($_POST['email']) . '" required>';
                            } else {
                                //echo '<input type="text" name="email" value="" placeholder="Please enter your Email here">';
                                echo '<input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>';
                            } ?>

		                  <label for="inputEmail">Email address</label>
		                </div>

		                <div class="form-label-group">
		                  <input type="password" id="inputPassword" class="form-control" name="pwd" placeholder="Password" required>
		                  <label for="inputPassword">Password</label>
		                </div>
                        <?php
                        if (isset($login_error)) {
                          echo '<div class="span-fp-error" style="color:darkred">' . $login_error . '<br></div>';
                        }
                        ?>
		                <div class="custom-control custom-checkbox mb-3">
		                  <input type="checkbox" class="custom-control-input" id="customCheck1">
		                  <label class="custom-control-label" for="customCheck1">Remember password</label>
		                </div>
		                <input class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="login" value="Sign in">
		                <div class="text-center">
		                  <a class="small" href="#">Forgot password?</a></div>
		              </form>
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