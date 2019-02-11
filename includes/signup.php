<?php

if(isset($_POST['signup'])){
	$name    = $_POST['uname'];
	$email    = $_POST['email'];
	$password = $_POST['psw'];

	if(empty($email) or empty($password) or empty($name)){
      $error="All fields are mandatory";
  }
  else{
  	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       	$error="Invalid email format";
       }else if(strlen($name)  < 7 && ctype_alpha($name)){
	$error="Invalid name format";
       }else if(strlen($password) < 7){ 
         $error="Password is too short";
       }else
       {
       	if($getUser->emailCheck($email)==true){
       		 $error="Email already exist";
       	}else{
   $getUser->register($email, $name ,$password);
    header('Location: home.php');
       	}
       } 
  }
       
}

?>




<form method="post">
<div class="signup-div"> 
  <h3>Sign up </h3>
  <ul>
    <li>
        <input type="text" name="uname" placeholder="Full Name"/>
    </li>
    <li>
        <input type="email" name="email" placeholder="Email"/>
    </li>
    <li>
      <input type="password" name="psw" placeholder="Password"/>
    </li>
    <li>
      <input type="submit" name="signup" Value="Tato">
    </li>
  </ul>
 </div>
   <?php
    if(isset($error)){
      echo '<div class="span-fp-error">'.$error.'</div>';
    } 
    ?>
</form>