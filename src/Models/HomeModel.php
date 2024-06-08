<?php

namespace model;

class HomeModel{

    // Função para executar as queries no nosso banco de dados.
    private function executarQuery($conexao, $query){
        $result = mysqli_query($conexao, $query);

        if (!$result) {
            die("Erro na execução da query: " . mysqli_error($conexao));
        }

        return $result;
    }

    function getValues($conexao, $data){
        $data['nome']= $this->getPrimeiroNome($conexao, $data['id']);
        $data['pathFicha']= $this->getFichaPath($conexao, $data['id']);
        $data['pathAval']= $this->getAvalPath($conexao, $data['id']);
        $data['isSuperUser']= $this->isSuperUser($conexao, $data['id']);

        return $data;
    }

    function getPrimeiroNome($conexao, $id){
        $sql = "select nome from usuario where id= '$id'";
        $result = $this->executarQuery($conexao, $sql);

        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $row = mysqli_fetch_assoc($result);

        $nome = explode(' ', trim($row['nome']));
        return $nome[0];
    }

    function getAvalPath($conexao, $id){
        $sql= "select pdf_avaliacao from usuario where id='$id'";
        $result= $this->executarQuery($conexao, $sql);

        if(mysqli_num_rows($result) == 0) return false;

        $row = mysqli_fetch_assoc($result);
        return $row['pdf_avaliacao'];
    }

    function getFichaPath($conexao, $id){
        $sql= "select pdf_ficha from usuario where id='$id'";
        $result= $this->executarQuery($conexao, $sql);

        if(mysqli_num_rows($result) == 0) return false;

        $row = mysqli_fetch_assoc($result);
        return $row['pdf_ficha'];
    }

    function isSuperUser($conexao, $id){
        $sql = "select superuser from usuario where id= '$id'";
        $result = $this->executarQuery($conexao, $sql);

        if (mysqli_num_rows($result) == 0) return false;

        $row = mysqli_fetch_assoc($result);

        if($row['superuser'] == "1") return true;
        return false;
    }
}