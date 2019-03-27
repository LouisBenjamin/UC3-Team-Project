<?php

require_once __DIR__ . '/../core/init.php';

if (isset($_POST['signup'])) {
    $name = $_POST['signUpName'];
    $email = $_POST['signUpEmail'];
    $password = $_POST['signUpPwd'];
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
    <div class="form-label-group">
        <input type="text" class="form-control" id="signUpName" name="signUpName" placeholder="Full Name">
        <label for="signUpName">Full Name</label>
    </div>
    <div class="form-label-group">
        <input type="email" class="form-control" id="signUpEmail" name="signUpEmail" placeholder="Email address" required>
        <label for="signUpEmail">Email Address</label>
    </div>

    <div class="form-label-group">
        <input type="password" class="form-control" id="signUpPwd" name="signUpPwd" placeholder="Password" required>
        <label for="signUpPwd">Password</label>
    </div>
    <?php
    if (isset($login_error)) {
        echo '<div class="span-fp-error" style="color:darkred">' . $login_error . '<br></div>';
    }
    ?>
    <input class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit"
           name="signup" value="I'm In!">
</form>
