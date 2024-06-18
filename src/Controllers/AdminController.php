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
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        } 
        $admindata = new AdminController(null, null, null);

        $_SESSION['admindata'] = $admindata->adminModel->obterTodosUsuarios($admindata->conexao);

        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/AdminHome.php";
    }

    public static function carregarTelaAdminAdd(){
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/AdminAdd.php";
    }

    public static function carregarTelaAdminEdit(){
        if(session_status() == PHP_SESSION_NONE) session_start();
        $_SESSION['idEdit'] = $_POST['id'];
        $_SESSION['idk'] = self::getUser($_POST['id']);
        include $_SERVER['DOCUMENT_ROOT'] . "/src/Views/AdminEdit.php";
    }
    
    public static function getUser($id){
        $idk = new self(null, null, null);
        $idk2 = [];
        $idk2 = $idk->adminModel->getUserById($idk->conexao, $id);

        return $idk2;
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

    public static function actionDelete() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $adminController = new AdminController(null, null, null);
            $result = $adminController->delete($id);
    
            if ($result) {
                header("Location: /admin");
            } else {
                header("Location: /admin?error=delete_failed");
            }
        } else {
            header("Location: /admin");
        }
    }

    public function delete($id) {
        return $this->adminModel->excluir($this->conexao, $id);
    } 

    public function add(){
        $result= $this->adminModel->adicionar($this->conexao,$this->data, $this->avalPath, $this->fichaPath);
        if($result){
            header("Location: /admin");
        }else{
            header("Location: /admin/add");
        }
    }
    public static function actionEdit(){
        if(isset($_POST['botaoAdminEdit'])){
            if(session_status() == PHP_SESSION_NONE) session_start();
            $data= [
                "id" => $_SESSION['idEdit'],
                "nome"=> $_POST['nome'],
                "email"=> $_POST['email'],
                "cpf"=> $_POST['cpf'],
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
            $action->edit();

        }else{
            header("Location: /admin");
        }
    }

    public function edit(){
        $id = $this->data['id'];
        $result= $this->adminModel->editar($this->conexao,$id, $this->data, $this->avalPath, $this->fichaPath);
        if($result){
            header("Location: /admin");
        }else{
            header("Location: /admin/edit");
        }
    }

}