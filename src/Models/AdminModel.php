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

    public function getUserById($conexao, $id) {
        $sql = "SELECT * FROM usuario WHERE id = '$id'";
        $result = $this->executarQuery($conexao, $sql);

        return mysqli_fetch_assoc($result);
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

    function excluir($conexao, $id): bool {
        $id = mysqli_escape_string($conexao, $id);
        $sql = "DELETE FROM usuario WHERE id = '$id'";
        $result = $this->executarQuery($conexao, $sql);
    
        return $result ? true : false;
    }
    
    function editar($conexao, $id, $data, $avalPath, $fichaPath): bool{
        $nome = mysqli_real_escape_string($conexao, $data['nome']);
        $email = mysqli_real_escape_string($conexao, $data['email']);
        $cpf = mysqli_real_escape_string($conexao, $data['cpf']);
        $telefone = mysqli_real_escape_string($conexao, $data['telefone']);
        $dtNascimento = mysqli_real_escape_string($conexao, $data['dtNascimento']);
        $pdfAval = mysqli_real_escape_string($conexao, $avalPath);
        $pdfFicha = mysqli_real_escape_string($conexao, $fichaPath);
    
        $sql = "UPDATE usuario SET nome='$nome', email='$email', cpf='$cpf', telefone='$telefone', dt_nascimento='$dtNascimento', pdf_avaliacao='$pdfAval', pdf_ficha='$pdfFicha' WHERE id='$id'";
        $result = $this->executarQuery($conexao, $sql);
        return $result ? true : false;
    }
    
}

