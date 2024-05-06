<?php
session_start(); // Inicia a sessão

global $conn;
include "conexao.php";

if(isset($_POST['cpf']) && isset($_POST['senha'])) {
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM usuario WHERE cpf = '$cpf' AND senha = '$senha'";
    $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

    $quantidade = $sql_query->num_rows;
    if($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: index.php");
        exit();
    } else {
        $erro = "Usuário ou senha incorretos!";
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
        <?php if(isset($erro)) { ?>
            <p><?php echo $erro; ?></p>
        <?php } ?>
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
