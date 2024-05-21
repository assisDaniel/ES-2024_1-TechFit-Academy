<?php

namespace controller;

use model\Conexao;
use model\LoginModel;
use model\CadastroModel;

class Controller{
    public $conexao;
    public $loginModel;
    public $cadastroModel;

    // Aqui eu faço instanciação com todos os modelos.
    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->getConexao();
        $this->loginModel = new LoginModel();
        $this->cadastroModel= new CadastroModel();
    }
}
