<?php
require "vendor/autoload.php";

$url = explode("/", $_SERVER["REQUEST_URI"]);

switch ($url[1]) {
    case "":
        controller\IndexController::carregarTelaInicial();
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
            if(isset($url[2])){
                if($url[2]=="logout"){
                    controller\HomeController::actionLogout();
                    break;
                }

                if($url[2]=="ficha"){
                    controller\HomeController::actionTreino();
                    break;
                }

                if($url[2]=="avaliacao"){
                    controller\HomeController::actionAval();
                    break;
                }

                if($url[2]== "info"){
                    controller\HomeController::actionInfo();
                    break;
                }

            }
            controller\HomeController::carregarTelaHome();
            break;
    
        default:
            http_response_code(404);
            echo 'Página não encontrada';
            break;
    
}
?>
