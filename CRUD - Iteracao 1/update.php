<?php
global $conn;
include "conexao.php";
include "header.php";

$id = $_GET["id"];

if(isset($_POST['submit'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $dt_nascimento= $_POST['dt_nascimento'];

    $avaFileName= "avaliacao-".$nome."-".$_FILES["pdf_avaliacao"]["name"]; // nome do arquivo com cpf para que não haja sobrescrição
    $tempname= $_FILES["pdf_avaliacao"]["tmp_name"]; //nome temporário para guardar o arquivo
    $avaUploadDir= './pdf-files/avaliacao/'; //diretório de upload
    move_uploaded_file($tempname, $avaUploadDir.$avaFileName); //mover o arquivo upado para um local específico

    $fichaFileName= "ficha-".$nome."-".$_FILES["pdf_ficha"]["name"];
    $tempname = $_FILES["pdf_ficha"]["tmp_name"];
    $fichaUploadDir= './pdf-files/ficha/';
    move_uploaded_file($tempname, $fichaUploadDir.$fichaFileName);

    $sql = "update `usuario` set `nome`='$nome', `email`='$email', `cpf`='$cpf', `telefone`='$telefone', `dt_nascimento`='$dt_nascimento', `pdf_avaliacao`='$avaUploadDir$avaFileName', `pdf_ficha`='$fichaUploadDir$fichaFileName' where `id`='$id'";

    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: adminHome.php");
    }else{
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Update</title>
</head>
<body>
    <div class="container">
        <div class="text-center mb-3">
            <h3>Informações do usuário:</h3>
        </div>
    </div>

    <?php
        $sql = "select `nome`, `email`, `cpf`, `telefone`, `dt_nascimento`, `pdf_avaliacao`, `pdf_ficha`  from `usuario` where id = $id limit 1";
        $result= mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
        <form method="post" style="width:50vw; min-width: 300px" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label"> Nome: </label>
                    <input type="text" class="form-control" name="nome" value="<?php echo $row['nome']?>">
                </div>

                <div class="col">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row['email']?>">
                </div>

                <div class="col">
                    <label class="form-label">CPF:</label>
                    <input type="text" class="form-control" name="cpf" value="<?php echo $row['cpf']?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Telefone:</label>
                    <input type="tel" class="form-control" name="telefone" value="<?php echo $row['telefone']?>">
                </div>

                <div class="col">
                    <label class="form-label">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="dt_nascimento" value="<?php echo $row['dt_nascimento']?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="form-label">Avaliação Física:</label>
                <input type="File" class="form-control" name="pdf_avaliacao" value="<?php echo $row['pdf_avaliacao']?>">
            </div>

            <div class="row mb-3">
                <label class="form-label">Ficha de Treino:</label>
                <input type="File" class="form-control" name="pdf_ficha" value="<?php echo $row['pdf_ficha']?>">
            </div>

            <button type="submit" class="btn btn-secondary" name="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>