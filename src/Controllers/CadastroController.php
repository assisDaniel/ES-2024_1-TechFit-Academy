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
                $senha= $_POST['senha'];
                $contato= $_POST['contato'];
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

        $this->resultadoCadastro= $this->cadastroModel->cadastrar($this->conexao, $data);

        if($this->resultadoCadastro){
            header("Location: /login");
        }else{
            header("Location: /cadastro");
        }
    }

}
?>
