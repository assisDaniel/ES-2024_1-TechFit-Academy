<?php 
    include('conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação fisica</title>
</head>
<body>
<?php
            
            $id_usuario = 11;          
            $sql = "SELECT pdf_avaliacao FROM usuario WHERE id = $id_usuario";
           
            //$usuario = $_POST['usuario'];
            //$senha = $_POST['senha'];

           // $sql = "SELECT pdf_ficha FROM techfit_es.usuario WHERE email = '$usuario' AND senha = '$senha'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Exibir o PDF se estiver disponível
                while($row = $result->fetch_assoc()) {
                    $caminho_pdf = $row["pdf_avaliacao"];
                    if($caminho_pdf) {
                        echo "<embed src='$caminho_pdf' type='application/pdf' width='100%' height='1000px' />";
                    } else {
                        echo "Arquivo PDF não encontrado.";
                    }
                }
            } else {
                echo "Usuário não encontrado.";
            }

            $conn->close();         
            
            
             ?>
</body>
</html>