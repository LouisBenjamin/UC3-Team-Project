<?php

class User
{
  /** @var $pdo PDO */
  protected $pdo;

  function __construct($pdo) {
    $this->pdo = $pdo;
  }

  /** @var $pdo PDO */
  public static function getUserFromId($pdo, $uid) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');
    $stmt->execute(array($uid));
    return $stmt->fetch(PDO::FETCH_OBJ);
  }

  /** @var $pdo PDO */
  public static function login($email, $password, $pdo) {
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

  public function emailCheck($email) {
    $stmt = $this->pdo->prepare('SELECT email FROM users WHERE email=:email');
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function register($email, $name, $password) {
        echo $email;
    $stmt = $this->pdo->prepare('INSERT INTO users (username,email,psw) VALUES (:name, :email, :password)');
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
  }

  public function upload($file, $user_id) {

    $stmt = $this->pdo->prepare('UPDATE users SET profile_image =:file WHERE user_id=:user');
    $stmt->bindParam(':file', $file);
    $stmt->bindParam(':user', $user_id);
    try {
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

  }


}

?>