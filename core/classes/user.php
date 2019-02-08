<?php
class User{
	protected $pdo;

	function __construct($pdo){
	$this->pdo = $pdo;
	}

	/*public function ValidateInput($var){
		$var = htmlspecialchars($var);
		$var =trim($var);
		$var =stripcslashes($var);
		returm $var;
	}*/
	public function login($email, $password)
	{
		$stmt = $this->pdo->prepare("SELECT 'user_id' FROM 'users' WHERE 'email'=:email AND 'password'=:password");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->execute();

		$user=$stmt->fetch(PDO::FETCH_OBJ);
		$count=$stmt->rowCount();

		if($count > 0){
                $SESSION['user_id']= $user->user_id;
                header('Location : home.php');
		}else{
              return false;
		}

	}

	public function emailCheck($email)
   {
   	$stmt = $this->pdo->prepare("SELECT 'email' FROM 'users' WHERE 'email'=:email ");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
 $count=$stmt->rowCount();

		if($count > 0){
                return true;
		}else{
              return false;
		}
   }

   public function register($email,$name,$password){

   	$stmt = $this->pdo->prepare("INSERT INTO 'users' ('email','password','name') VALUES(:email, :password, :name)  ");

   	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->bindParam(":name", $name, PDO::PARAM_STR);
		$stmt->execute();

		$user_id=$this->pdo->lastInsertId()
		$_SESSION['user_id']=$user_id;

   }


}
?>