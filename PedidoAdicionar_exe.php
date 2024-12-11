<?php
// PedidoAdicionar.php
require 'bd/conectaBD.php'; 

// Verificar se o ID do produto foi passado via GET
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Recuperar os dados do produto
    $sql = "SELECT * FROM Produtos WHERE ID_Produtos = '$id_produto'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // Inserir o produto na lista do usuário (tabela Pedidos)
        $nome_produto = $row['Nome'];
        $descricao_produto = $row['Descricao'];
        $preco_produto = $row['Preco'];
        $quantidade = 1; 
        
        $id_usuario = 1;

        // Inserir o produto no pedido
        $sql_inserir = "INSERT INTO Pedidos (ID_Usuario, ID_Produto, Nome, Descricao, Quantidade, Preco) 
                        VALUES ('$id_usuario', '$id_produto', '$nome_produto', '$descricao_produto', '$quantidade', '$preco_produto')";
        
        if (mysqli_query($conn, $sql_inserir)) {
            echo "Produto adicionado à lista com sucesso!";
        } else {
            echo "Erro ao adicionar o produto: " . mysqli_error($conn);
        }
    }
} else {
    echo "Produto não encontrado.";
}

mysqli_close($conn);
?>
