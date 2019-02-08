<?php
if(isset($_POST['login']) && !empty($_POST['login'])){
	$email    = $_POST['email'];
	$password = $_POST['password']

	if(!empty($email) or !empty($password)){
		/*$email= $getUser->validateInput($email);
	$password = $getUser->validateInput($password);*/
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       	$error="Invalid format";
       }else{
              if($getUser->login($email, $password) === false){
              	$error="The email or password is incorrect";
              }
       }
	}else{
		$error="Please enter the credentials"; 
	}
}
?>

<form method="post"> 


	<div class="login">
		<h3>Login</h3>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter email" name="email" required>
<br />
<br />
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit" name="login">Login</button>
    <? php
    if(isset($error)){
    	echo '<div class="span-fp-error">'.$error.'</div>';
    } 
    ?>

  </div>
	
	</form>
