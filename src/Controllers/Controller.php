<?php

namespace controller;

use model\AdminModel;
use model\ApiModel;
use model\Conexao;
use model\HomeModel;
use model\LoginModel;
use model\CadastroModel;

class Controller{
    public $conexao;
    public $loginModel;
    public $cadastroModel;
    public $homeModel;
    public $apiModel;
    public $adminModel;

    // Aqui eu faço instanciação com todos os modelos.
    public function __construct(){
        $this->conexao = new Conexao();
        $this->conexao = $this->conexao->getConexao();
        $this->loginModel = new LoginModel();
        $this->cadastroModel= new CadastroModel();
        $this->homeModel= new HomeModel();
        $this->apiModel= new ApiModel();
        $this->adminModel= new AdminModel();
    }
}
