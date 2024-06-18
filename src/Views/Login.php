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
        <form action="login/process" method="post">
            <label for="cpf">CPF</label><br>
            <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" oninput="formatarCPF(this)">
            <br>
            <label for="password">Senha</label><br>
            <input type="password" id="password" name="senha" placeholder="Máximo 30 caracteres">
            <br>
            <button type="submit" class="button-5" name="botaoLogin">Entrar</button>
        </form>
        <p>Ainda não possui conta? <a href="/cadastro">Cadastre-se</a></p>
    </div>
    <div class="alert">
        <?php
        if(session_status() == PHP_SESSION_NONE) session_start();
        if(isset($_SESSION['erroCPF'])){
            echo '<p class="message">' . $_SESSION['erroCPF'] . '</p>';
            unset($_SESSION['erroCPF']);
        }
        ?>
    </div>
</div>
</body>
<script>
    function formatarCPF(campo) {
        let cpf = campo.value.replace(/\D/g, '');
        if (cpf.length > 11) cpf = cpf.substr(0, 11);

        campo.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/,
            function(regex, part1, part2, part3, part4) {
                let formattedCPF = part1 + '.' + part2 + '.' + part3;
                if (part4) formattedCPF += '-' + part4;
                return formattedCPF;
            }
        );
    }
</script>
</html>