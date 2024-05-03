<?php
global $conn;
include "conexao.php";

if(isset($_POST['cpf']) || isset($_POST['senha'])) {

    if(strlen($_POST['cpf']) == 0) {
        echo "Preencha com seu CPF";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $cpf = $conn->real_escape_string($_POST['cpf']);
        $senha = $conn->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE cpf = '$cpf' AND senha = '$senha'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();            

            header("Location: index.php");

        } else {  
            ?>
            <script>
                    alert("Usuário ou senha incorretos!");
            </script>          
            <?php 
            
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