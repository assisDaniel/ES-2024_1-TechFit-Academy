<?php
namespace model;

use Exception;

class CadastroModel
{
    // Função para executar as queries no nosso banco de dados.
    private function executarQuery($conexao, $query){
        $result = mysqli_query($conexao, $query);

        if (!$result) {
            die("Erro na execução da query: " . mysqli_error($conexao));
        }

        return $result;
    }

    //Função que efetivamente cadastra o usuário na plataforma.
    function cadastrar($conexao, $data): bool
    {
        $nome= mysqli_escape_string($conexao, $data['nome']);
        $email= mysqli_escape_string($conexao, $data['email']);
        $cpf= mysqli_escape_string($conexao, $data['cpf']);
        $senha= mysqli_escape_string($conexao, $data['senha']);
        $contato= mysqli_escape_string($conexao, $data['contato']);
        $dataNascimento= mysqli_escape_string($conexao, $data['dataNascimento']);

        $sql = "insert into usuario(nome, email, cpf, senha, telefone, dt_nascimento) values ('$nome','$email','$cpf','$senha','$contato','$dataNascimento')";
        $result = $this->executarQuery($conexao, $sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }
}
?>
