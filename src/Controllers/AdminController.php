<?php
namespace controller;

class AdminController extends Controller{
    private $data;
    private $avalPath;
    private $fichaPath;

    public function __construct($data, $avalPath, $fichaPath){
        parent::__construct();
        $this->data = $data;
        $this->avalPath = $avalPath;
        $this->fichaPath = $fichaPath;
    }

    public static function carregarTelaAdmin(){
        //...
    }

    public static function carregarTelaAdminAdd(){
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/AdminAdd.php";
    }

    public static function carregarTelaAdminEdit(){
        //...
    }

    public static function actionAdd(){
        if(isset($_POST['botaoAdminAdd'])){
            $data= [
                "nome"=> $_POST['nome'],
                "email"=> $_POST['email'],
                "cpf"=> $_POST['cpf'],
                "senha"=> $_POST['senha'],
                "telefone"=> $_POST['telefone'],
                "dtNascimento"=> $_POST['dtNascimento']
            ];

            $avaFileName= $data['cpf']." - ".$_FILES["aval"]["name"]; // nome do arquivo com cpf para que não haja sobrescrição
            $tempname= $_FILES["aval"]["tmp_name"]; //nome temporário para guardar o arquivo
            $avaUploadDir= 'src/pdf-files/avaliacao/'; //diretório de upload
            $avaCompleteDir= $avaUploadDir.$avaFileName;
            move_uploaded_file($tempname, $avaCompleteDir); //mover o arquivo upado para um local específico

            $fichaFileName= $data['cpf']." - ".$_FILES["ficha"]["name"]; // nome do arquivo com cpf para que não haja sobrescrição
            $tempname= $_FILES["ficha"]["tmp_name"]; //nome temporário para guardar o arquivo
            $fichaUploadDir= 'src/pdf-files/ficha/'; //diretório de upload
            $fichaCompleteDir= $fichaUploadDir.$fichaFileName;
            move_uploaded_file($tempname, $fichaCompleteDir);

            $action= new AdminController($data, $avaCompleteDir, $fichaCompleteDir);
            $action->add();

        }else{
            header("Location: /admin");
        }
    }

    public static function actionDelete(){
        //...
    }

    public function add(){
        $result= $this->adminModel->adicionar($this->conexao,$this->data, $this->avalPath, $this->fichaPath);
        if($result){
            header("Location: /admin");
        }else{
            header("Location: /admin/add");
        }
    }
}