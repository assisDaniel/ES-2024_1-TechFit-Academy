<?php
use PHPUnit\Framework\TestCase;
use controller\AdminController;

class AdminAddValidatorsTest extends TestCase{

    function testValidateCPF(){
        $this->assertTrue(AdminController::validarCPF('069.273.701-45'));
        $this->assertTrue(AdminController::validarCPF('078.517.441-99'));

        $this->assertFalse(AdminController::validarCPF('111.111.111-11'));
        $this->assertFalse(AdminController::validarCPF('123.123.123-12'));
    }
}