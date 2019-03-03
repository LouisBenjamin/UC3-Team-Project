<?php
if (isset($_POST['email']) && isset($_POST['pwd'])) {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid format";
  } else {
    if (User::login($_POST['email'], $_POST['pwd'], $pdo) === false) {
      $error = "The email or password is incorrect";
    }
  }
}
?>

<div class="login-div">
    <form method="post">
        <ul>
            <li>
              <?php
              if (isset($_POST["email"])) {
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
      if(isset($error)){
        echo '<div class="span-fp-error">'.$error.'</div>';
      }
      ?>
    </form>
</div>