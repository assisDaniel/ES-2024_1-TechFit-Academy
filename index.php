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
                controller\HomeController::carregarTelaInfo();
                break;
            }

        }
        controller\HomeController::carregarTelaHome();
        break;

        case "info":
            controller\InfoController::carregarTelaInfo();
            break;    

    case "api":
        if(isset($url[2])){
            if(is_numeric($url[2])){
                controller\ApiController::apiUser($url[2]);
                break;
            }
        }
        controller\ApiController::apiAllUsers();
        break;

    case "admin":
        if(isset($url[2])){
            if($url[2] == "add"){
                if(isset($url[3])){
                    if($url[3]=="process"){
                        controller\AdminController::actionAdd();
                        break;
                    }
                }
                controller\AdminController::carregarTelaAdminAdd();
                break;
            }else if($url[2] == "edit"){
                controller\AdminController::carregarTelaAdminEdit();
                break;
            }else if($url[2] == "delete"){
                controller\AdminController::actionDelete();
            }
        }
        controller\AdminController::carregarTelaAdmin();
        break;

    default:
        http_response_code(404);
        echo 'Página não encontrada';
        break;

}
?>
