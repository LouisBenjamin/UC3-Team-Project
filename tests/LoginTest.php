<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '\..\includes\login.php';
class LoginTest extends TestCase
{
  /**
   * A basic test example.
   * Src: https://github.com/n2chao/SOEN341/blob/master/app/tests/Unit/ExampleTest.php
   * @return void
   */
  public function testLogin()
  {
    // False using combination not in database
    $this->assertFalse(login("a@b.com","abc"));

    //
  }
}