<?php
require 'bd/conectaBD.php';

// Captura os dados do formulário
$nicho = $_POST['Nicho'];
$nome = $_POST['Nome'];
$descricao = $_POST['Descricao'];
$preco = $_POST['Preco'];
$quantidade = $_POST['Quantidade'];
$data_fabricacao = $_POST['Dt_Fabricacao'];
$data_validade = $_POST['Dt_Validade'];

// Conexão com o banco de dados
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica a conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Configura para caracteres especiais
mysqli_set_charset($conn, "utf8");

// Verifica se o produto já existe
$sql_verifica = "SELECT * FROM Produtos WHERE Nome='$nome'";
$resultado = mysqli_query($conn, $sql_verifica);

if (mysqli_num_rows($resultado) > 0) {
    echo "<script>alert('Produto já existe!'); window.location.href='OrganizarPedidos.php';</script>";
} else {
    // Insere o produto na tabela Produtos
    $sql_produto = "INSERT INTO Produtos (Nicho, Nome, Descricao, Preco) VALUES ('$nicho', '$nome', '$descricao', '$preco')";
    if (mysqli_query($conn, $sql_produto)) {
        // Obtém o ID do produto recém-criado
        $produto_id = mysqli_insert_id($conn);

        // Insere na tabela Produtos_Pedidos
        $sql_pedido = "INSERT INTO Produtos_Pedidos (fk_Produtos_ID_Produtos, Quantidade, Dt_Fabricacao, Dt_Validade)
                       VALUES ('$produto_id', '$quantidade', '$data_fabricacao', '$data_validade')";
        if (mysqli_query($conn, $sql_pedido)) {
            echo "<script>alert('Produto e pedido adicionados com sucesso!'); window.location.href='OrganizarPedidos.php';</script>";


        } else {
            echo "Erro ao inserir pedido: " . mysqli_error($conn);
        }
    } else {
        echo "Erro ao inserir produto: " . mysqli_error($conn);
    }
}

// Fecha a conexão
mysqli_close($conn);
?>
