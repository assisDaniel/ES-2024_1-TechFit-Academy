<?php
namespace model;

use mysqli;

class AdminModel{

    public $rows;

    private function executarQuery($conexao, $query){
        $result= mysqli_query($conexao, $query);

        if(!$result){
            die("Erro na execução da query: ". mysqli_error($conexao));
        }
        return $result;
    }

    function adicionar($conexao, $data, $avalPath, $fichaPath): bool{
        $nome= mysqli_escape_string($conexao, $data['nome']);
        $email= mysqli_escape_string($conexao, $data['email']);
        $cpf= mysqli_escape_string($conexao, $data['cpf']);
        $senha= mysqli_escape_string($conexao, $data['senha']);
        $telefone= mysqli_escape_string($conexao, $data['telefone']);
        $dtNascimento= mysqli_escape_string($conexao, $data['dtNascimento']);
        $pdfAval= mysqli_escape_string($conexao, $avalPath);
        $pdfFicha= mysqli_escape_string($conexao, $fichaPath);


        $sql = "insert into usuario(nome, email, cpf, senha, telefone, dt_nascimento, pdf_avaliacao, pdf_ficha) values ('$nome','$email','$cpf','$senha','$telefone','$dtNascimento', '$pdfAval', '$pdfFicha')";
        $result = $this->executarQuery($conexao, $sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }

        function obterTodosUsuarios($conexao) {
            $usuarios = [];
            $sql = "SELECT id, nome, cpf FROM usuario";
            $result = $this->executarQuery($conexao, $sql);
    
            while ($row = mysqli_fetch_assoc($result)) {
                $usuarios[] = $row;
            }     
            return $usuarios;
        }      
}

