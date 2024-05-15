<?php

namespace model;

use controller\LoginController;

class LoginModel{

    // Função para executar as queries no nosso banco de dados.
    private function executarQuery($conexao, $query){
        $result = mysqli_query($conexao, $query);

        if (!$result) {
            die("Erro na execução da query: " . mysqli_error($conexao));
        }

        return $result;
    }

    // Função que verifica se os dados inseridos no form do Login batem com aqueles do db;
    function verificaLogin($conexao, $data): bool{
        //mysqli_escape_string é usado para evitar sql injections.

        $cpf = mysqli_escape_string($conexao, $data["cpf"]);
        $senha = mysqli_escape_string($conexao, $data["senha"]);

        $sql = "select * from usuario where cpf= '$cpf'";
        $result = mysqli_fetch_assoc($this->executarQuery($conexao, $sql));

        if (!$result || $result['senha'] != $senha) {
            return false;
        } else {
            return true;
        }
    }

    //Função que retorna o id do usuário através de seu cpf.
    function getId($conexao, $cpf){
        $sql = "select id from usuario where cpf= '$cpf'";
        $result = $this->executarQuery($conexao, $sql);

        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $row = mysqli_fetch_assoc($result);

        return $row['id'];
    }

    //Função que retorna o nome do usuário através de seu cpf.
    function getNome($conexao, $cpf){
        $sql = "select nome from usuario where cpf= '$cpf'";
        $result = $this->executarQuery($conexao, $sql);

        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $row = mysqli_fetch_assoc($result);
        return $row['nome'];
    }
}