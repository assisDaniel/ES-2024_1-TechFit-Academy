<?php
namespace controller;

class ApiController extends Controller{
    private $data;
    public function __construct($data){
        parent::__construct();
        $this->data= $data;
    }


    static function apiAllUsers(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(session_status() == PHP_SESSION_DISABLED){
            header("Location: /login");
            exit();
        }

        $getter= json_decode($_SESSION['loginData'], true);
        $id= $getter['id'];
        $isSuperUser= (new ApiController(null))->checkSuper($id);
        $_SESSION['superUser']= $isSuperUser;

        if(!isset($id)){
            header("Location: /login");
            exit();
        }

        if(isset($_SESSION['superUser'])){
            $data=[];

            $api= new ApiController($data);
            $api->data= $api->apiModel->getAllUsers($api->conexao);
            $_SESSION['api']= json_encode($api->data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

            include $_SERVER['DOCUMENT_ROOT'].'/src/Views/Api.php';
        }
    }

    static function apiUser($id){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(session_status() == PHP_SESSION_DISABLED){
            header("Location: /login");
            exit();
        }

        $getter= json_decode($_SESSION['loginData'], true);
        $idAdmin= $getter['id'];

        if(!isset($idAdmin)){
            header("Location: /login");
            exit();
        }

        $data=[];
        $api= new ApiController($data);
        $api->data= $api->apiModel->getUser($api->conexao, $id);
        $_SESSION['api']= json_encode($api->data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);

        include $_SERVER['DOCUMENT_ROOT'].'/src/Views/Api.php';
    }

    function checkSuper($id){
        return $this->apiModel->isSuperUser($this->conexao, $id);
    }
}