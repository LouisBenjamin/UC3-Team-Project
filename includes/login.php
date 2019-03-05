<?php

  /**
   * @param $email string email of logging in user
   * @param $password string password of logging in user
   * @param $pdo PDO handle to access database
   * @return bool if failed then return false
   */

  function login($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT user_id FROM users WHERE email=:email AND psw=:password LIMIT 1');
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    try {
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $stmt->rowCount();
    if ($count > 0) {
      $_SESSION['user_id'] = $user->user_id;
      // Per http://php.net/manual/en/function.header.php
      $host = $_SERVER['HTTP_HOST'];
      $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      $home_url = 'home.php';
      header("Location: http://$host$uri/$home_url");
      exit;
    } else {
      return false;
    }
  }

if (isset($_POST['email']) && isset($_POST['pwd'])) {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid format";
  } else {
    if (login($_POST['email'], $_POST['pwd']) === false) {
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
      if(isset($error)){
        echo '<div class="span-fp-error">'.$error.'</div>';
      }
      ?>
    </form>
</div>