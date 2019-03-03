<?php
//error_reporting(E_ALL);
//ini_set("display_errors", TRUE);
require 'core/init.php';

?>
<!doctype html>
<html lang="en-US">
<head>
    <title>Tato</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="assets/css/style-complete.css"/>
</head>
<!--Helvetica Neue-->

<body>
<div class="front-img">
    <img src="assets/images/montreal.jpg" alt="montreal view"/>
</div>


<div class="main-container">
    <!-- content left-->
    <div class="content-left">
        <h1>Welcome to Tato.</h1>
        <br/>
        <p>A place to connect with your friends — and Get updates from the people you love, And get the updates from the
            world and things that interest you.</p>
    </div><!-- content left ends -->

    <!-- content right ends -->
    <div class="content-right">
        <!-- Log In Section -->
        <div class="login-wrapper">
            <!--     			    /* Abir Check if the session variable user is set */ -->
          <?php if (isset($_SESSION['user_id'])) { ?>
              <p> Show logout button </p>
            <?php
          } else {
              require('includes/login.php');
          } ?>
        </div>
        <!--log in wrapper end-->

        <!-- SignUp Section -->
        <div class="signup-wrapper">
          <?php if (isset($_SESSION['user_id'])): ?>
              <p> Already logged in, go to <a href="home.php"> home </a>. </p>
          <?php else: ?>
            <p> Not logged in
            <p>
              <?php require 'includes/signup.php';
              endif; ?>
        </div>
        <!-- SIGN UP wrapper end -->

    </div><!-- content right ends -->

</div><!-- main container end -->


<!-- ends wrapper -->
</body>
</html>