<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/svg" href="/src/Views/static/icons/favicon.svg">
    <title>Admin - Home</title>

    
    <link rel="stylesheet" href="/src/Views/static/css/global.css">
    <link rel="stylesheet" href="/src/Views/static/css/AdmHome.css">
    <link rel="icon" href="/src/Views/static/icons/favicon.svg" type="image/svg">
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
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
    
            $getter= json_decode($_SESSION['userData'], true);
            //        var_dump($getter);
            echo $getter['nome'];
            //            echo "Admin";
            ?>
        </p>
    
        </div>
        <div class="logout">
            <a href="home/logout">
                <img src="/src/Views/static/icons/logout.svg">
            </a>
        </div>

<div class="tudo">
    
        <div class="h1main">
            <h1>Lista de Usuários</h1>
        </div>
    
        <div class="addbutton">
                <a href="admin/add" id="add">Adicionar</a>
        </div>
    
        <div class="container">
            <table>
                <thead>
                    <tr>
                         <th scope='col' id="thnome">Nome</th>
                         <th scope='col' id="thcpf">CPF</th>
                         <th scope='col' id="thopcoes">Opções</th>
                    </tr>
                </thead>
                <tbody>
                
                 <?php 
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                } 
                 $usuarios =  $_SESSION['admindata'];
                 foreach ($usuarios as $usuario): ?> 
                        <tr>                          
                            <td id="nome"><?php echo htmlspecialchars($usuario['nome']); ?></td> 
                            <td id="cpf"><?php echo htmlspecialchars($usuario['cpf']); ?></td> 
                            <td id="opcoes">
                            <a href="AdminEdit.php?id=<?php echo $usuario['id']; ?>"><img src="/src/Views/static/icons/pen.svg" width="25px"></a>
                            <a href="AdminDelete.php?id=<?php echo $usuario['id']; ?>"><img src="/src/Views/static/icons/lixo.svg" width="25px"></a> 
                            </td> 
                        </tr>
                     <?php endforeach?> 
                </tbody>
            </table>
        </div>
</div>
</body>