<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/src/Views/static/css/LoginStyle.css">
    <link rel="icon" href="/src/Views/static/icons/favicon.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,900&family=Poppins:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
<div class="tudo">    
    <div class="img-style"><img src="/src/Views/static/icons/logo-techfit1.svg" alt="logo" onclick="window.location.href='/'"></div>
    <h1>Login</h1>
    <div class="form">
        <?php
        $getter= [];

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if (isset($_SESSION['camposInvalidos'])) {
            $getter= json_decode($_SESSION['camposInvalidos'], true);
            echo '<p>' . $getter['camposInvalidos'] .'</p>';
            unset($_SESSION['camposInvalidos']);
            unset($getter);
        }

        if (isset($_SESSION['errosLogin'])) {
            $getter= json_decode($_SESSION['errosLogin'], true);
            foreach ($getter as $campo => $erro) {
                echo '<p>' . $campo . ':' . $erro . '</p>';
            }
            unset($_SESSION['errosLogin']);
            unset($getter);
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
</div>
</body>
</html>