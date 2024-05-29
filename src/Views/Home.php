<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/svg" href="/src/Views/static/icons/favicon.svg">
    <title>Home</title>

    <link rel="stylesheet" href="/src/Views/static/css/home.css">
    <link rel="stylesheet" href="/src/Views/static/css/global.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,900&family=Poppins:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
<div class="userInfo">
    <div class="userImage">
        <img src="/src/Views/static/icons/user.svg" alt="Imagem do usuário">
    </div>

    <p>
        <?php
//        var_dump($_SESSION);
        echo $_SESSION['nome'];
        ?>
    </p>

    <div class="logout">
        <a href="home/logout">
            <img src="/src/Views/static/icons/logout.svg">
        </a>
    </div>
</div>

<div class="title">
    <h1>Funcionalidades</h1>
</div>

<div class="container">
    <button type="button" name="botaoAval" class="box" onclick="window.open('home/ficha')" ">
        <img class="boxImage" src="/src/Views/static/icons/peso.svg">
        <h1>Treino</h1>
        <p>Ficha de exercícios</p>
    </button>

    <button type="button" name="botaoAval" class="box" onclick="window.open('home/avaliacao')">
        <img class="boxImage" src="/src/Views/static/icons/fita-metrica.svg">
        <h1>Avaliações</h1>
        <p>Veja sua evolução</p>
    </button>

    <button type="button" name="botaoInfo" class="box" onclick="window.location.href='home/info'">
        <img class="boxImage" src="/src/Views/static/icons/calendario.svg">
        <h1>Informações</h1>
        <p>Horários e contatos</p>
    </button>
</div>

</body>
</html>