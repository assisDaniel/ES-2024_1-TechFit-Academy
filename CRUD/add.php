<?php
global $conn;
include_once ("conexao.php");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $senha = $_POST['senha'];

    
    $avaFileName= "avaliacao-".$nome."-".$_FILES["pdf_avaliacao"]["name"]; // nome do arquivo com cpf para que não haja sobrescrição
    $tempname= $_FILES["pdf_avaliacao"]["tmp_name"]; //nome temporário para guardar o arquivo
    $avaUploadDir= './pdf-files/avaliacao/'; //diretório de upload
    move_uploaded_file($tempname, $avaUploadDir.$avaFileName); //mover o arquivo upado para um local específico

    $fichaFileName= "ficha-".$nome."-".$_FILES["pdf_ficha"]["name"]; // nome do arquivo com cpf para que não haja sobrescrição  
    $tempname= $_FILES["pdf_ficha"]["tmp_name"]; //nome temporário para guardar o arquivo
    $fichaUploadDir= './pdf-files/ficha/'; //diretório de upload
    move_uploaded_file($tempname, $fichaUploadDir.$fichaFileName); //mover o arquivo upado para um local específico
    
    $sql = "INSERT INTO usuario (nome, email, cpf, telefone, dt_nascimento, pdf_avaliacao, pdf_ficha, senha) VALUES ('$nome', '$email', '$cpf', '$telefone', '$dt_nascimento', '$avaUploadDir$avaFileName', '$fichaUploadDir$fichaFileName', '$senha')";

    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
        header("Location: adminHome.php");
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }
}
?>
<?php include "header.php"?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastro</title>
</head>
<body> 
    <div class="container d-flex justify-content-center">
        <form method="post" style="width:50vw; min-width: 300px" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nome:</label>
                    <input type="text" class="form-control" name="nome" required>
                </div>

                <div class="col">
                    <label class="form-label">Senha: (máximo 8 caracteres)</label>
                    <input type="password" class="form-control" name="senha" required>
                </div>

                <div class="col">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="col">
                    <label class="form-label">CPF:</label>
                    <input type="text" class="form-control" name="cpf" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Telefone:</label>
                    <input type="tel" class="form-control" name="telefone" required>
                </div>

                <div class="col">
                    <label class="form-label">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="dt_nascimento" required>
                </div>

                <div class="row mb-3">
                    <label class="form-label">Avaliação Física:</label>
                    <input type="File" class="form-control" name="pdf_avaliacao">
                </div>

                <div class="row mb-3">
                    <label class="form-label">Ficha de Treino:</label>
                    <input type="File" class="form-control" name="pdf_ficha">
                </div>
            </div>

            <button type="submit" class="btn btn-secondary" name="submit">Adicionar</button>
        </form>
    </div>
    </body>
</html>
