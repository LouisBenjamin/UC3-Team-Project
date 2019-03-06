<?php

require_once('core\init.php');
/**
 * @param $email string email of logging in user
 * @param $password string password of logging in user
 * @return bool success then true, fail then false
 */
function signUpName($name) : bool {
   if(strlen($name)  < 7 && ctype_alpha($name)){
           return true;
       }else { 
           return false;
       }
}

function signUpEmail($email) : bool {
   if(filter_var($email, FILTER_VALIDATE_EMAIL)){
           return true;
       }else { 
           return false;
       }
}

function signUpPassword($password) : bool {
   if(strlen($password) < 7){ 
         return false;
       }else{
        return true;
       }
}

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