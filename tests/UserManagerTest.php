<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/init.php';

class UserManagerTest extends TestCase
{

    public function testLogin() {
        global $getUserManager;
        // False using random combination in database
        $this->assertFalse($getUserManager->login('badem@il', 'fail'));

        // False using combination not in database
        $this->assertFalse($getUserManager->login('a@b.com', 'abc'));

        // True using combination in database
        $this->assertTrue($getUserManager->login('y@z.com', 'z'));


  }
}