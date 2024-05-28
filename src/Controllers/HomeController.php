<?php

namespace controller;

class HomeController extends Controller{
    private $id;
    private $nome;
    private $pathFicha;
    private $pathAval;

    public function __construct(){
        parent::__construct();
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

        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Home.php";
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
        if(isset($_POST['botaoTreino'])){

        }
    }

    public static function actionAval(){
        if(isset($_POST['botaoAval'])){

        }
    }

    public static function actionInfo(){
        if(isset($_POST['botaoInfo'])){

        }
    }
}