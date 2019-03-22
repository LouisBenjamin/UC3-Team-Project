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
    <form method="post">
        <ul>
            <li>
              <?php
              if (isset($_POST['email'])) {
                echo '<input type="text" name="email" value="' . htmlspecialchars($_POST['email']) . '" />';
              } else {
                echo '<input type="text" name="email" value="" placeholder="Please enter your Email here">';
              } ?>
            </li>
            <li>
                <input type="password" name="pwd" placeholder="password"/>
                <input type="submit" name="login" value="Log in"/>
            </li>
        </ul>
      <?php
      if (isset($login_error)) {
        echo '<div class="span-fp-error">' . $login_error . '</div>';
      }
      ?>
    </form>
</div>