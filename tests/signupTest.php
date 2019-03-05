<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '\..\includes\signup.php';



class SignUpTest extends TestCase
{
  public function testSignupName()
  {
    // False name combination
    $this->assertFalse(signUpName('steve@'));

    // True name combination
    $this->assertTrue(signUpName('steve rogers'));

   
  }


  public function testSignupEmail()
  {
  	// False email combination
    $this->assertFalse(signUpEmail('steve@@#'));

    // True email combination
    $this->assertTrue(signUpEmail('steve@gmail.com'));

  }

  public function testSignupPassword()
  {

   // False password combination
    $this->assertFalse(signUpPassword('ste'));

    // True password combination
    $this->assertTrue(signUpPassword('steve123456'));
  }
}
?>