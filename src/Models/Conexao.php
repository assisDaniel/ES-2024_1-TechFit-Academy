<?php

namespace model;

use mysqli_sql_exception;

class Conexao{
    private $hostname = "viaduct.proxy.rlwy.net";
    private $username = "root";
    private $password = "NiSNqFEZKvMKrfSwIzQnKTrhiuQbgTxj";
    private $dbname = "railway";
    private $port = 58592;

    private $conn;

    // Conexão com o DB
    function getConexao(){
        try {
            $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname, $this->port);
            return $this->conn;
        } catch (mysqli_sql_exception $error) {
            echo "Erro na conexão: " . $error->getMessage();
        }
    }
}

?>