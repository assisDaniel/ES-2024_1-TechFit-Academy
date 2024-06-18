<?php

namespace controller;

class LoginController extends Controller{
    private $cpf;
    private $senha;

    public function __construct($cpf, $senha){
        parent::__construct();
        $this->cpf = $cpf;
        $this->senha = $senha;
    }

    //Inicia o $_SESSION e joga pra Tela de Login.
    public static function carregarTelaLogin(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        include $_SERVER["DOCUMENT_ROOT"] . "/src/Views/Login.php";
    }

    // Evento disparado ao clicar no botão "Entrar" na Tela de Login.
    public static function actionLogin(){
        if (isset($_POST['botaoLogin'])) {
            if (!empty($_POST['cpf']) && !empty($_POST['senha'])) {
                $cpf = $_POST['cpf'];
                if(!self::validarCPF($cpf)){
                    $cpf= "** CPF inválido **";
                    if(session_status() == PHP_SESSION_NONE) session_start();
                    $_SESSION['erroCPF'] = $cpf;
                }
                $senha = $_POST['senha'];

                $login = new LoginController($cpf, $senha);
                $login->Login();
            } else {
                $erros = [];

                if (empty($_POST['cpf'])) $erros['CPF'] = "O campo cpf deve ser preenchido!";
                if (empty($_POST['senha'])) $erros['Senha'] = "O campo senha deve ser preenchido!";

                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['errosLogin'] = json_encode($erros);
                header("Location: /login");
            }
        }
    }

    // Função que joga para a Tela Home caso o usuário exista.
    public function Login(){
        $data = [
            "cpf" => $this->cpf,
            "senha" => $this->senha
        ];

        if($data['cpf'] === "** CPF inválido **"){
            header("Location: /login");
            exit();
        }

        $result = $this->loginModel->verificaLogin($this->conexao, $data);

        if ($result) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['loginData']= json_encode([
                "id"=> $this->loginModel->getId($this->conexao, $data['cpf']),
                "nome"=> $this->loginModel->getNome($this->conexao, $data['cpf'])
            ]);

            if($this->loginModel->isSuperUser($this->conexao, $this->loginModel->getId($this->conexao, $data['cpf']))){
                header("Location: /admin");
                exit();
            }else{
                header("Location: /home");
                exit();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['camposInvalidos'] = json_encode([
                "camposInvalidos"=>"CPF ou Senha incorretos!"
            ]);
            header("Location: /login");
        }
    }

    static function validarCPF($cpf) {
        // Remove caracteres especiais
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Elimina CPFs inválidos conhecidos
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}