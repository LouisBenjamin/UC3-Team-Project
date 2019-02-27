<?php
class User{
    protected $pdo;
    function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function login($email,$password)
    {
        $stmt = $this->pdo->prepare('SELECT user_id FROM users WHERE email=:email AND psw=:password');
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        try{
            $stmt->execute();
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $user=$stmt->fetch(PDO::FETCH_OBJ);
        $count=$stmt->rowCount();
        if($count > 0){
            $_SESSION['user_id']= $user->user_id;
            header('Location: home.php');
        }else{
            return false;
        }
    }
    public function emailCheck($email)
    {
        $stmt = $this->pdo->prepare('SELECT email FROM users WHERE email=:email');
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $count=$stmt->rowCount();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }
    public function register($email,$name,$password){
        echo $email;
        $stmt = $this->pdo->prepare('INSERT INTO users (username,email,psw) VALUES (:name, :email, :password)');
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }

    public static function getUserFromId($pdo,$uid) {
      $sel_user = $pdo->prepare('SELECT username,user_id,fan_count FROM users WHERE user_id = ? LIMIT 1');
      $sel_user->execute(array($uid));
      return $sel_user->fetch(PDO::FETCH_OBJ);
    }

     public function upload($file,$user_id){
        $stmt = $this->pdo->prepare("UPDATE users SET profile_image =:file where user_id=:user");
        $stmt->bindParam(":file", $file);
        $stmt->bindParam(":user", $user_id);
        try{
            $stmt->execute();
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

      public function image_retrieve($user_id)
    {

    
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id=:user");
        $stmt->bindParam(":user", $user_id);
        $stmt->execute();


            return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

}
?>