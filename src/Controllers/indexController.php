<?php
namespace controller;

class indexController extends Controller{
    public static function carregarTelaInicial(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/index.php";
    }
}
?>
