<?php
global $conn;
include "conexao.php"; // Inclui o arquivo de conexão

// Verifica se o ID foi fornecido e é válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id']; // Garantir que é um número

    // Prepara uma declaração SQL para evitar SQL injection
    $stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: adminHome.php"); 
        exit;
    } else {
        echo "Erro ao deletar o registro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}
//$conn->close();
?>
