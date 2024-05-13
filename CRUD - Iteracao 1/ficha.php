<?php 
   // include_once 'includes/conexao.php';
    include('conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha do Aluno</title>
</head>
<body>
<tbody>
        <?php
            
            $id_usuario = 11;          
            $sql = "SELECT pdf_ficha FROM usuario WHERE id = $id_usuario";
            //metodo post para pegar usuario e senha digitados no login
            //$email = $_POST['email'];
            //$senha = $_POST['senha'];
            //query para pegar caminho correto para pdf
           //$sql = "SELECT pdf_ficha FROM usuario WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Exibir o PDF se estiver disponível
                while($row = $result->fetch_assoc()) {
                    $caminho_pdf = $row["pdf_ficha"];
                    if($caminho_pdf) {
                        echo "<iframe src='$caminho_pdf' width='100%' height='1000px' style='border: none;'></iframe>";
                    } else {
                        echo "Arquivo PDF não encontrado.";
                    }
                }
            } else {
                echo "Usuário não encontrado.";
            }

            $conn->close();                  
        ?>
</tbody>
</body>
</html>