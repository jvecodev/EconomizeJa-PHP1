<?php
require 'bd/conectaBD.php';

// Verifica se o parâmetro 'id' foi passado
if (isset($_GET['id'])) {
    $id_pedido = $_GET['id'];

    // Conexão com o banco de dados
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Verifica a conexão
    if (!$conn) {
        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
    }

    // Excluir o item do pedido (da tabela Pedido)
    $sql = "DELETE FROM Pedido WHERE ID_Pedido = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Vincula o ID do pedido ao parâmetro da consulta
        mysqli_stmt_bind_param($stmt, "i", $id_pedido);

        // Executa a exclusão
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Item excluído com sucesso!</p>";
        } else {
            echo "<p>Erro ao excluir o item: " . mysqli_error($conn) . "</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($conn);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);

    // Redireciona para a página de carrinho após a exclusão
    header('Location: carrinho.php');
    exit;
} else {
    echo "ID do pedido não especificado.";
}
?>
