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

    public static function image_retrieve($uid) {
        $pdo = Dbh::getInstance()->dbh;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');
        $stmt->execute(array($uid));
        $obj = $stmt->fetch(PDO::FETCH_OBJ);
        return $obj->profile_image;
    }
    
    /**
     * @param $email string email of logging in user
     * @param $password string password of logging in user
     * @return bool success then true, fail then false
     */
    function login($email, $password) {
        /** @var PDO $pdo */
        $stmt = $this->pdo->prepare('SELECT user_id,psw FROM users WHERE email=:email LIMIT 1');
        $stmt->bindParam(":email",$email);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $count = $stmt->rowCount();
        if ($count > 0) {
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if (password_verify($password,$user->psw)) {
                $_SESSION['user_id'] = $user->user_id;
                return true;
            }
        }
        return false;
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
        $stmt = $this->pdo->prepare('INSERT INTO users (username,email,psw) VALUES (:name, :email, :password)');
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }

    public function uploadPic($file, $user_id) {
        $pdo = Dbh::getInstance()->dbh;
        $stmt = $pdo->prepare('UPDATE users SET profile_image =:file WHERE user_id=:user');
        $stmt->bindParam(':file', $file);
        $stmt->bindParam(':user', $user_id);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }
    
    public static function updateUserInfo($screenname, $username, $bio,
        $website, $email, $country, $user_id) {
            $pdo = Dbh::getInstance()->dbh;
            $stmt = $pdo->prepare('UPDATE users SET screen_name =:screenname,
                            username = :username, bio = :bio, website = :website,
                            email = :email, country = :country WHERE user_id=:user');
            $stmt->bindParam(':screenname', $screenname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':website', $website);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':user', $user_id);
         
            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    }

}

?>