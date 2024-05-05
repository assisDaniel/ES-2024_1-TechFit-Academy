<?php
session_start(); // Inicia a sessão

global $conn;
include "conexao.php";

if(isset($_POST['cpf']) || isset($_POST['senha'])) {

    if(strlen($_POST['cpf']) == 0) {
        echo "Preencha com seu CPF";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $stmt = $conn->prepare("SELECT * FROM usuario WHERE cpf = ? LIMIT 1");
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();

            if(password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                header("Location: index.php");
                exit();
            } else {
                echo "Usuário ou senha incorretos!";
            }
        } else {  
            echo "Usuário ou senha incorretos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="img-style"><img src="imagens/logo-techfit1.png" alt="logo"></div>
    <h1>Login</h1>    
    <div class="form">
        <form action="login.php" method="post">
            <label for="cpf">CPF</label><br>
            <input type="text" id="cpf" name="cpf">
            <br>
            <label for="password">Senha</label><br>
            <input type="password" id="password" name="senha" required>
            <br>
            <button type="submit" class="button-5" role="button">Entrar</button>
        </form>
        <p>Ainda não possui conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</body>
</html>
