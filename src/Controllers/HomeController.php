<?php

namespace controller;

class HomeController extends Controller{
    private $id;
    private $nome;
    private $pathFicha;
    private $pathAval;
    private $isSuperUser;

    public function __construct($id, $nome, $pathFicha, $pathAval, $isSuperUser){
        parent::__construct();
        $this->id = $id;
        $this->nome = $nome;
        $this->pathFicha = $pathFicha;
        $this->pathAval = $pathAval;
        $this->isSuperUser = $isSuperUser;
    }

    public static function carregarTelaHome(){
        if(session_status() == PHP_SESSION_DISABLED){
            header("Location: /login");
            exit();
        }

        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }

        $getter= json_decode($_SESSION['loginData'], true);
        $id= $getter['id'];
        $nome= $getter['nome'];

        if(!isset($id)){
            header("Location: /login");
            exit();
        }

        $user = new HomeController($id, $nome, null, null, null);
        $user->setValues();
        $_SESSION['userData']= json_encode([
            "nome"=>$user->nome,
            "pathFicha"=>$user->pathFicha,
            "pathAval"=>$user->pathAval,
            "isSuperUser"=>$user->isSuperUser
        ]);

        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Home.php";
    }

    public function setValues(){
        $data = [
            "id"=> $this->id,
            "nome"=>$this->nome,
            "pathFicha"=>$this->pathFicha,
            "pathAval"=>$this->pathAval,
            "isSuperUser"=>$this->isSuperUser
        ];

        $data= $this->homeModel->getValues($this->conexao, $data);

        $this->nome= $data['nome'];
        $this->pathFicha= $data['pathFicha'];
        $this->pathAval= $data['pathAval'];
        $this->isSuperUser= $data['isSuperUser'];

        return $this;
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
        $getter= json_decode($_SESSION['userData'], true);
        $path= $getter['pathFicha'];

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
        $getter= json_decode($_SESSION['userData'], true);
        $path= $getter['pathAval'];

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