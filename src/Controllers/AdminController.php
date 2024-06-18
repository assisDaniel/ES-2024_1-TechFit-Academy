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

            if(!self::validarCPF($data['cpf'])){
                $data['cpf']= "** CPF inválido **";
                if(session_status() == PHP_SESSION_NONE) session_start();
                $_SESSION['erroCPF']= $data['cpf'];
            }

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
        if($this->data['cpf'] === "** CPF inválido **"){
            header("Location: /admin/add");
            exit();
        }

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