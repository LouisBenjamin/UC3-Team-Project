<?php

require_once __DIR__.'/../core/init.php';

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

<div class="login-div">
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
    </form>
</div>