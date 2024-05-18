<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Dados dos alunos</title>

</head>
<body style="text-align: center;">
<header class="page-header">
    <div class="page-header">
        <h1 class="display-1 text-center" style="background-color: lightblue"><a href="adminHome.php" style="text-decoration: none; color: black; font-size: 50pt">TechFit Academy</a></h1>
    </div>
</header>
<h1>Visualizar informações</h1>
<?php
    if(session_status() == PHP_SESSION_NONE) session_start();
    echo "Essa tela não é definitiva, só está aqui temporariamente para ter uma tela de destino depois da ação de Login.";
echo '<p>' . "\n" . '</p>';
echo "ID: ".$_SESSION["id"];
echo '<p>' . "\n" . '</p>';
echo "Nome: ".$_SESSION["nome"];
?>
<br>
<a href="ficha.php">
    <button type="button" class="btn btn-primary">Visualizar Ficha</button>
</a>

<a href="avaliacao.php">
    <button type="avaliacao.php" class="btn btn-primary">Visualizar Avaliação</button>
</a>



</body>