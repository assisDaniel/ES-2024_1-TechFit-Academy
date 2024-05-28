<?php
namespace controller;

class indexController extends Controller{
    public static function carregarTelaInicial(){
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Index.php";
    }
}
?>
