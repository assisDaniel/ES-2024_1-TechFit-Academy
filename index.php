<?php
require "vendor/autoload.php";

$url = explode("/", $_SERVER["REQUEST_URI"]);

switch ($url[1]) {
    case "":
        controller\LoginController::carregarTelaLogin();
        break;

    case "login":
        if (isset($url[2])) {
            if ($url[2] == "process") {
                controller\LoginController::actionLogin();
                break;
            }
        }
        controller\LoginController::carregarTelaLogin();
        break;

    case "cadastro":
        if (isset($url[2])) {
            if ($url[2] == "process") {
                controller\CadastroController::actionCadastro();
                break;
            }
        }
        controller\CadastroController::carregarTelaCadastro();
        break;

    case "home":
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Home.php"; //eventualmente será substituído por carregarTelaHome()
        break;
}
?>