<?php
require 'bd/conectaBD.php';

// Conecta ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("<strong>Falha de conexão: </strong>" . mysqli_connect_error());
}

// Captura os dados do formulário
$id_pedido = $_POST['Id'];
$id_produto = $_POST['ProdutoId'];

// Inicia a transação
mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

// Tenta excluir o pedido e o produto
try {
    // Exclui o pedido
    $sql_pedido = "DELETE FROM Produtos_Pedidos WHERE ID_Produtos_Pedidos = ?";
    if ($stmt = mysqli_prepare($conn, $sql_pedido)) {
        mysqli_stmt_bind_param($stmt, "i", $id_pedido);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        throw new Exception("Erro ao excluir pedido: " . mysqli_error($conn));
    }

    // Exclui o produto (somente se não houver outros pedidos associados a ele)
    $sql_produto = "DELETE FROM Produtos WHERE ID_Produtos = ? AND NOT EXISTS (SELECT 1 FROM Produtos_Pedidos WHERE fk_Produtos_ID_Produtos = ID_Produtos)";
    if ($stmt = mysqli_prepare($conn, $sql_produto)) {
        mysqli_stmt_bind_param($stmt, "i", $id_produto);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        throw new Exception("Erro ao excluir produto: " . mysqli_error($conn));
    }

    // Commit da transação
    mysqli_commit($conn);
    echo "<p>Produto e pedido excluídos com sucesso!</p>";
    header('Location: OrganizarPedidos.php');
    exit;
} catch (Exception $e) {
    // Rollback em caso de erro
    mysqli_rollback($conn);
    echo "<p>Erro: " . $e->getMessage() . "</p>";
}

mysqli_close($conn);
?>
