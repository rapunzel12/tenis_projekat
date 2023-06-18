<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

use function PHPUnit\Framework\assertTrue;

final class Test extends CIUnitTestCase{
    // 1. stvari za pripremu testa
    // 2. stvar koja se testira
    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testLogin(){
        $result = $this->controller(Guest::class)->execute("login");
        assertTrue($result->see("Uloguj se"), "No login text!");
    }
    public function testUser(){
        $result = $this->controller(User::class)->execute("index");
        assertTrue($result->see("Dobrodošli, milicap"), "No login text!");
    }

}



?>