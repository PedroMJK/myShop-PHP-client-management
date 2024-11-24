<?php 
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Validação básica do ID
    if (!is_numeric($id)) {
        die("ID inválido.");
    }

    // Dados do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    // Criação da conexão
    $connection = new mysqli($servername, $username, $password, $database);

    // Verificação da conexão
    if ($connection->connect_error) {
        die("Falha na conexão: " . $connection->connect_error);
    }

    // Preparação da consulta SQL para evitar SQL Injection
    $stmt = $connection->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execução da consulta
    if ($stmt->execute()) {
        echo "Cliente excluído com sucesso.";
    } else {
        echo "Erro ao excluir cliente: " . $connection->error;
    }

    // Fechamento da conexão e redirecionamento
    $stmt->close();
    $connection->close();

    // Redireciona para a lista de clientes
    header("Location: /myshop/index.php");
    exit();
} else {
    echo "ID não fornecido.";
}
?>
