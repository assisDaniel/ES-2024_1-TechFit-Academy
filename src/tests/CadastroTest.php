<?php
use PHPUnit\Framework\TestCase;
use controller\CadastroController;

class CadastroTest extends TestCase
{
    public function testCadastroSucesso()
    {
        $nome = 'Testand';
        $email = 'teste@exemplo.co';
        $cpf = '123456780';
        $senha = 'teste123456';
        $contato = '123456723';
        $dataNascimento = '2010-01-07';

        $cadastro = new CadastroController($nome, $email, $cpf, $senha, $contato, $dataNascimento);

        // Chamando o método de cadastro
        $result = $cadastro->Cadastro();

        // Verificando se o cadastro foi bem-sucedido
        $this->assertTrue($result, 'Cadastro bem sucedido!');
    }
}
?>
