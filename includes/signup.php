<?php

if(isset($_POST['signup'])){
	$name    = $_POST['uname'];
	$email    = $_POST['email'];
	$password = $_POST['psw'];

	if(empty($email) or empty($password) or empty($name)){
      $sign_up_error="All fields are mandatory";
  }
  else{
  	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       	$sign_up_error="Invalid email format";
       }else if(strlen($name)  < 7 && ctype_alpha($name)){
	$sign_up_error="Invalid name format";
       }else if(strlen($password) < 7){ 
         $sign_up_error="Password is too short";
       }else
       {
       	if($getUser->emailCheck($email)==true){
       		 $sign_up_error="Email already exist";
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
    if(isset($sign_up_error)){
      echo '<div class="span-fp-error">'.$sign_up_error.'</div>';
    } 
    ?>
</form>