<?php

if(isset($_POST['signup'])){
	$name    = $_POST['uname'];
	$email    = $_POST['email'];
	$password = $_POST['password']

	if(!empty($email) or !empty($password) or !empty($name) ){
      $error="All fields are mandatory";
  }
  else{
  	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       	$error="Invalid email format";
       }else if(strlen($name)  < 10 && ctype_alpha($name)){
	$error="Invalid name format";
       }else if(strlen($password) < 7){ 
         $error="Password is too short";
       }else
       {
       	if($getUser->emailCheck($email)===true){
       		 $error="Email already exist";
       	}else{
   $getUser->register($email, $name ,$password);
   header('Location : home.php');
       	}
       } 
  }
       
}

?>
<form method="post">
<div class="signup-div"> 
	<h3>Sign up </h3>

    <label for="uname"><b>Name</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
<br />
<br />
<label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

<br />
<br />
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit" name="signup">SignUp</button>
    <? php
    if(isset($error)){
    	echo '<div class="span-fp-error">'.$error.'</div>';
    } 
    ?>

  </div>
	<!-- <ul>
		<li>
		    <input type="text" name="screenName" placeholder="Full Name"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup for Twitter">
		</li>
	</ul>
	<!--
	 <li class="error-li">
	  <div class="span-fp-error"></div>
	 </li> 
	 </div>
	--> 

</form>
