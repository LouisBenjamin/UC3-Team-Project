<?php

require_once __DIR__ . '/../database/connection.php';

class UserManager
{
    /** @var $pdo PDO */
    protected $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param $uid int user_id to identify user whom id is needed
     * @return mixed row corresponding to $uid
     */
    public static function getUserFromId($uid) {
        /** @var PDO $pdo */
        $pdo = Dbh::getInstance()->dbh;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');
        $stmt->execute(array($uid));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param $email string email of logging in user
     * @param $password string password of logging in user
     * @return bool success then true, fail then false
     */
    function login($email, $password): bool {
        /** @var PDO $pdo */
        $pdo = Dbh::getInstance()->dbh;
        $stmt = $pdo->prepare('SELECT user_id FROM users WHERE email=:email AND psw=:password LIMIT 1');
        $stmt->bindParam(":email",
            $email);
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
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $email string email of logging in user
     * @param $password string password of logging in user
     * @return bool success then true, fail then false
     */
    function validateName($name): bool {
        return (strlen($name) < 7 && ctype_alpha($name));
    }

    function validateEmail($email): bool {
        return (filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    function validatePassword($password): bool {
        return (strlen($password) >= 7);
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

    public function uploadPic($file, $user_id) {

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