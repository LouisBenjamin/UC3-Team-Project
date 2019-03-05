<?php

class User
{
  /** @var $pdo PDO */
  protected $pdo;

  function __construct($pdo) {
    $this->pdo = $pdo;
  }

  /**
   * @param $uid int user_id to identify user whom id is needed
   * @param $pdo PDO
   * @return mixed row corresponding to $uid
   */
  public static function getUserFromId($uid, $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');
    $stmt->execute(array($uid));
    return $stmt->fetch(PDO::FETCH_OBJ);
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