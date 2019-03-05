<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '\..\includes\login.php';
class LoginTest extends TestCase
{

  public function testLogin()
  {

    // False using random combination in database
    $this->assertFalse(login('badem@il','fail'));

    // False using combination not in database
    $this->assertFalse(login('a@b.com','abc'));

    // True using combination in database
    $this->assertTrue(login('y@z.com','z'));


  }
}