<?php
namespace model;

class ApiModel{

    private function executarQuery($conexao, $query){
        $result= mysqli_query($conexao, $query);

        if(!$result){
            die("Erro na execução da query: ". mysqli_error($conexao));
        }
        return $result;
    }

    function getAllUsers($conexao){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $data= [];
        $sql= "SELECT * FROM usuario";
        $result= $this->executarQuery($conexao, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        $getter= json_decode($_SESSION['userData'], true);
        if($getter['isSuperUser']){
            return $data;
        }

        return [
            "Status"=> 404,
            "Message"=>"Usuário sem permissão de acesso!"
        ];
    }

    function getUser($conexao, $id){
        $sql= "SELECT * FROM usuario WHERE id = '$id'";
        $result= $this->executarQuery($conexao, $sql);

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $getter= json_decode($_SESSION['userData'], true);
        if($getter['isSuperUser']){
            if(mysqli_num_rows($result) == 0){
                return [
                    "Status"=> "404",
                    "message"=>"ID não existente"
                ];
            }

            return mysqli_fetch_assoc($result);
        } else {
            return [
                "Status"=> 404,
                "Message"=>"Usuário sem permissão de acesso!"
            ];
        }

    }
}