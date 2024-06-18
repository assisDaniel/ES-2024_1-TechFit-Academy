<?php
namespace controller;

class CadastroController extends Controller
{
    private $nome;
    private $email;
    private $cpf;
    private $senha;
    private $contato;
    private $dataNascimento;
    private $resultadoCadastro;

    public function __construct($nome, $email, $cpf, $senha, $contato, $dataNascimento)
    {
        parent::__construct();
        $this->nome= $nome;
        $this->email= $email;
        $this->cpf= $cpf;
        $this->senha= $senha;
        $this->contato= $contato;
        $this->dataNascimento= $dataNascimento;
    }

    //Inicia uma session e joga pra tela de cadastro
    public static function carregarTelaCadastro()
    {
        session_start();

        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/Cadastro.php";
    }

    //Evento disparado ao clicar no botão "Cadastrar" na tela de cadastro
    public static function actionCadastro()
    {
        if(isset($_POST['botaoCadastro'])){
            if(!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['cpf']) && !empty($_POST['senha']) && !empty($_POST['contato']) && !empty($_POST['data_nascimento'])){
                $nome= $_POST['nome'];
                $email= $_POST['email'];
                $cpf= $_POST['cpf'];
                if(!self::validarCPF($cpf)){
                    $cpf= "** CPF inválido **";
                    if(session_status() == PHP_SESSION_NONE) session_start();
                    $_SESSION['erroCPF']= $cpf;
                }
                $senha= $_POST['senha'];
                $contato= $_POST['contato'];
                if(!self::validarTelefone($contato)){
                    $contato= "** Número inválido **";
                    if(session_status() == PHP_SESSION_NONE) session_start();
                    $_SESSION['erroTel']= $contato;
                }
                $dataNascimento= $_POST['data_nascimento'];

                $cadastro = new CadastroController($nome, $email, $cpf, $senha, $contato, $dataNascimento);
                $cadastro->Cadastro();
            }
        }else{
            header("Location: /cadastro");
        }
    }

    //Redirecionamento caso cadastro tenha sucesso ou não
    public function Cadastro()
    {
        $data= [
            "nome"=>$this->nome,
            "email"=>$this->email,
            "cpf"=>$this->cpf,
            "senha"=>$this->senha,
            "contato"=>$this->contato,
            "dataNascimento"=>$this->dataNascimento
        ];
        if($data['cpf'] === "** CPF inválido **" || $data['contato'] === "** Número inválido **"){
            header("Location: /cadastro");
            exit();
        }

        $this->resultadoCadastro= $this->cadastroModel->cadastrar($this->conexao, $data);

        if($this->resultadoCadastro){
            header("Location: /login");
        }else{
            header("Location: /cadastro");
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


    static function validarTelefone($numero)
    {
        // Regex para número de telefone no formato brasileiro
        $regex = '/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/';

        return preg_match($regex, $numero);
    }


}
?>
