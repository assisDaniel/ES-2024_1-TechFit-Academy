<?php

namespace controller;

use model\Conexao;
use model\HomeModel;
use model\LoginModel;
use model\CadastroModel;

class Controller{
    public $conexao;
    public $loginModel;
    public $cadastroModel;
    public $homeModel;

    // Aqui eu faço instanciação com todos os modelos.
    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->getConexao();
        $this->loginModel = new LoginModel();
        $this->cadastroModel= new CadastroModel();
        $this->homeModel= new HomeModel();
    }
}
