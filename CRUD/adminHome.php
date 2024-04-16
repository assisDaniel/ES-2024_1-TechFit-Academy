<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    BootStrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Home</title>
</head>
<br>
<div class="container">
    <div class="text-center mb-4">
        <h1 class="display-6">Lista de usuários: </h1>
    </div>
</div>
<div class="container">
    <!--    Trocar o href para a tela create depois-->
    <a href="add.php"><button class="btn btn-secondary mb-1">Adicionar</button></a>
    <table class="table text-center">
        <thead class="table-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Opção</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "conexao.php";
        global $conn;
        $sql= "select id, nome, cpf from usuario";
        $result = mysqli_query($conn, $sql);
        while($row= mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['nome']?></td>
                <td><?php echo $row['cpf']?></td>
                <td> </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>