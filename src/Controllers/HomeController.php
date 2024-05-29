<?php

namespace controller;

class HomeController extends Controller{
    private $id;
    private $nome;
    private $pathFicha;
    private $pathAval;
    private $data;

    public function __construct($id, $nome, $pathFicha, $pathAval){
        parent::__construct();
        $this->id = $id;
        $this->nome = $nome;
        $this->pathFicha = $pathFicha;
        $this->pathAval = $pathAval;
    }

    public static function carregarTelaHome(){
        if(session_status() == PHP_SESSION_DISABLED){
            header("Location: /login");
            exit();
        }

        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['id'])){
            header("Location: /login");
            exit();
        }

        $id= $_SESSION['id'];
        $nome = $_SESSION['nome'];

        $user = new HomeController($id, $nome, null, null);
        $user->setValues();

        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Home.php";
    }

    public function setValues(){
        $data = [
            "id"=> $this->id,
            "nome"=>$this->nome,
            "pathFicha"=>$this->pathFicha,
            "pathAval"=>$this->pathAval
        ];

        $this->data= $this->homeModel->getValues($this->conexao, $data);

        $_SESSION['nome']= $this->data['nome'];
        $_SESSION['pathFicha']= $this->data['pathFicha'];
        $_SESSION['pathAval']= $this->data['pathAval'];

        return new HomeController($data['id'], $data['nome'], $data['pathFicha'], $data['pathAval']);
    }

    public static function actionLogout(){
        session_start();
        $_SESSION = array();

        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        header("Location: /");
    }

    public static function actionTreino(){
        session_start();
        $path= $_SESSION['pathFicha'];

        if(file_exists($path)){
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'. basename($path). '"');
            header('Content-Length: '. filesize($path));

            readfile($path);
            exit();
        }else{
            echo "Arquivo não encontrado!\n";
            echo "Entre em contato conosco, '<a href='home/info'>Informações</a>'";
        }
    }

    public static function actionAval(){
        session_start();
        $path= $_SESSION['pathAval'];
        if(file_exists($path)){
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'. basename($path). '"');
            header('Content-Length: '. filesize($path));

            readfile($path);
            exit();
        }else{
            echo "Arquivo não encontrado!\n";
            echo "Entre em contato conosco, '<a href='home/info' style='text-decoration: black'>Informações</a>'";
        }
    }

    public static function carregarTelaInfo(){
        if(session_status() == PHP_SESSION_NONE) session_start();

        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Info.php"; //Arquivo ainda não existe.
    }
}