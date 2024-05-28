<?php
namespace controller;

class IndexController extends Controller{
    public static function carregarTelaInicial(){
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Index.php";
    }
}
?>
