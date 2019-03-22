<?php

require_once __DIR__ . '/../core/init.php';

if (isset($_POST['signup'])) {
    $name = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    if (empty($email) or empty($password) or empty($name)) {
        $sign_up_error = "All fields are mandatory";
    } else {
        if (!$getUserManager->validateEmail($email)) {
            $sign_up_error = "Invalid email format";
        } else if (!$getUserManager->validateName($name)) {
            $sign_up_error = "Invalid name format";
        } else if (!$getUserManager->validatePassword($password)) {
            $sign_up_error = "Password is too short";
        } else {
            if ($getUserManager->emailCheck($email) == true) {
                $sign_up_error = "Email already exist";
            } else {
                $getUserManager->register($email, $name, password_hash($password,PASSWORD_BCRYPT));
                $getUserManager->login($email,$password);
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
    if (isset($sign_up_error)) {
        echo '<div class="span-fp-error">' . $sign_up_error . '</div>';
    }
    ?>
</form>