<?php
use PHPUnit\Framework\TestCase;
use controller\CadastroController;

class CadastroValidatorsTest extends TestCase{

    function testValidateTel(){
        $this->assertTrue(CadastroController::validarTelefone("(63) 99208-0407"));
        $this->assertTrue(CadastroController::validarTelefone('63 992414142'));

        $this->assertFalse(CadastroController::validarTelefone('111.111.111-11'));
        $this->assertFalse(CadastroController::validarTelefone('11111'));
    }
}