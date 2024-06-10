<?php
namespace controller;

class InfoController extends Controller{
    public static function carregarTelaInfo(){
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Info.php";
    }
}
?>