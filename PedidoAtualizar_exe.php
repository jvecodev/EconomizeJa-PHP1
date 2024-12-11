<?php
require 'bd/conectaBD.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['Id']) ? (int) $_POST['Id'] : 0;
    $nome_produto = mysqli_real_escape_string($conn, $_POST['Nome_produto']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $quantidade = (int) $_POST['quantidade'];
    $preco = mysqli_real_escape_string($conn, $_POST['preco']);
    $nicho = mysqli_real_escape_string($conn, $_POST['nicho']);

    if ($id <= 0) {
        die("ID inválido.");
    }

    // Atualiza as informações na tabela Produtos
    $sql = "UPDATE Produtos SET Nome = ?, Descricao = ?, Preco = ?, Nicho = ? WHERE ID_Produtos = 
            (SELECT fk_Produtos_ID_Produtos FROM Produtos_Pedidos WHERE ID_Produtos_Pedidos = ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $nome_produto, $descricao, $preco, $nicho, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            // Atualiza as informações na tabela Produtos_Pedidos
            $sql2 = "UPDATE Produtos_Pedidos SET Quantidade = ? WHERE ID_Produtos_Pedidos = ?";
            
            if ($stmt2 = mysqli_prepare($conn, $sql2)) {
                mysqli_stmt_bind_param($stmt2, "ii", $quantidade, $id);
                mysqli_stmt_execute($stmt2);
            }
            
            echo "<p>Produto atualizado com sucesso!</p>";
            header("Location: OrganizarPedidos.php");
            exit();
        } else {
            echo "<p>Erro ao atualizar produto: " . mysqli_error($conn) . "</p>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Erro ao preparar a consulta: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
?>
