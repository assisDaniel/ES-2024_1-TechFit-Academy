<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="/src/Views/static/css/LoginStyle.css">
    <link rel="icon" href="/src/Views/static/icons/favicon.svg" type="image/svg">
</head>
<body>
<div class="img-style"><img src="/src/Views/static/icons/logo-techfit1.svg" alt="logo"></div>
<h1>Login</h1>
<div class="form">
    <?php
    if (isset($_SESSION['camposInvalidos'])) {
        echo '<p>' . $_SESSION['camposInvalidos'] . '</p>';
        unset($_SESSION['camposInvalidos']);
    }

    if (isset($_SESSION['erros'])) {
        foreach ($_SESSION['erros'] as $campo => $erro) {
            echo '<p>' . $campo . ':' . $erro . '</p>';
        }
        unset($_SESSION['erros']);
    }
    ?>
    <form action="login/process" method="post">
        <label for="cpf">CPF</label><br>
        <input type="text" id="cpf" name="cpf">
        <br>
        <label for="password">Senha</label><br>
        <input type="password" id="password" name="senha">
        <br>
        <button type="submit" class="button-5" name="botaoLogin">Entrar</button>
    </form>
    <p>Ainda não possui conta? <a href="/cadastro">Cadastre-se</a></p>
</div>
</body>
</html>