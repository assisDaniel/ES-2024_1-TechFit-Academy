<?php

namespace controller;

use model\Conexao;
use model\LoginModel;

class Controller{
    public $conexao;
    public $loginModel;

    // Aqui eu faço a instanciação com todos os modelos.
    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->getConexao();
        $this->loginModel = new LoginModel();
    }
}
